<?php

namespace Sunhill\Collection\Tasks;

use Sunhill\Collection\SimpleCalDAV\SimpleCalDAVClient;
use Sunhill\Collection\SimpleCalDAV\VCalendar;
use Sunhill\Collection\Objects\Dates\Date;

class UpdateCalDAV
{
    
    protected function getClient()
    {
        $server   = env('CALENDAR_SERVER','');
        $user     = env('CALENDAR_USER','');
        $password = env('CALENDAR_PASSWORD','');
        
        if (empty($server) || empty($user) || empty($password)) {
            throw new \Exception('Calendar interface not configured in .env file.');
        }
        
        $client = new SimpleCalDAVClient();
        $client->connect($server, $user, $password);
        
        return $client;
    }
    
    protected function getCalendars($client)
    {
        return $client->findCalendars();
    }
    
    protected function parseEvent($event)
    {
        $parser = new VCalendar();
        $data = $parser->toArray($event->getData());
        
        return $data['VCALENDAR'][0];
    }
    
    protected function handleDate(string $kind, string $key, string $value, array &$values)
    {
        $datetime = new \DateTime($value);
        $values[$kind.'_date'] = $datetime->format('Y-m-d');
        if (substr($key,0,5) == ';tzid') {
            list($date,$time) = explode('T',$value);
            $values[$kind.'_time'] = $datetime->format('H:i:s');
            return;
        }
    }
    
    protected function formatUUID(string $input): string
    {
        $input = strtolower($input);
        if (strpos($input, '-') == false) {
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split($input, 4));
        }
        return $input;
    }
    
    protected function importEvent($event)
    {
        $event = $this->parseEvent($event);
        
        if (Date::query()->where('_uuid',$event['VEVENT'][0]['uid'])->first()) {
            return; // Date already imported
        }
        
        $values = ['created'=>'','uid'=>'','start_date'=>'',
                   'startn_time'=>'','end_date'=>'','end_time'=>'','summary'=>''];  
        foreach ($event['VEVENT'][0] as $key => $value) {
            switch ($key) {
              case 'summary':
                  $values['summary'] = $value;
                  break;
              case 'uid':
                  $values['uid'] = $this->formatUUID($value);
                  break;
              case 'dstamp':
                  $values['created'] = $value;
                  break;
              default:
                  if (substr($key,0,7) == 'dtstart') {
                     $this->handleDate('start',substr($key,7), $value, $values);
                  } else if (substr($key,0,5) == 'dtend') {
                      $this->handleDate('end',substr($key,7), $value, $values);                      
                  }
            }
        }
        
        $date = new Date();
        $date->name = $values['summary'];
        $date->begin_date = $values['start_date'];
        if (!empty($values['end_date'])) {
            $date->end_date = $values['end_date'];
        }
        if (!empty($values['begin_time'])) {
            $date->begin_time = $values['start_time'];
        }
        if (!empty($values['end_time'])) {
            $date->end_time = $values['end_time'];
        }
        $date->commit();
        if (!empty($values['uid'])) {
            $date->_uuid = $values['uid'];
            $date->commit();
        }
    }
    
    protected function syncCalendar($client, $calendar)
    {
        $client->setCalendar($calendar);
        
        $now = new \DateTime();
        $now_stamp = $now->format('Ymd\THms\Z');
        $end = $now->add(new \DateInterval('P1Y'));
        $end_stamp = $end->format('Ymd\THms\Z');
        
        $events = $client->getEvents($now_stamp, $end_stamp); // Returns array($firstNewEventOnServer, $secondNewEventOnServer);
        
        foreach ($events as $event) {
            $this->importEvent($event);
        }
    }
    
    public function __invoke()
    {
        $client = $this->getClient();
        $calendars = $this->getCalendars($client);
        
        foreach ($calendars as $calendar) {
            $this->syncCalendar($client, $calendar);
        }
    }
    
}