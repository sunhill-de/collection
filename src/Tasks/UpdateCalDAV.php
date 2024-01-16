<?php

namespace Sunhill\Collection\Tasks;

use Sunhill\Collection\SimpleCalDAV\SimpleCalDAVClient;
use Sunhill\Collection\SimpleCalDAV\VCalendar;
use Sunhill\Collection\Objects\Dates\Date;
use ICal\ICal;

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
    
    protected function isValidUUID(string $input): bool
    {
        return preg_match("/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i", $input);    
    }
    
    protected function importEvent($event)
    {
        $ical = new ICal(null, array(
            'defaultSpan'                 => 2,     // Default value
            'defaultTimeZone'             => 'Europe/Berlin',
            'defaultWeekStart'            => 'MO',  // Default value
            'disableCharacterReplacement' => false, // Default value
            'filterDaysAfter'             => null,  // Default value
            'filterDaysBefore'            => null,  // Default value
            'httpUserAgent'               => null,  // Default value
            'skipRecurrence'              => false, // Default value
        ));
        $ical->initString($event->getData());
        $events = $ical->eventsFromInterval('1 year');
        
        $uid = $this->formatUUID($events[0]->uid);
        if (Date::query()->where('unique_id', $uid)->first()) {
            return; // Date(sequence) already imported
        }
        
        foreach ($events as $event) {
            $date = new Date();
            $date->name = $event->summary;
            $begin_stamp = new \DateTime($event->dtstart);
            $end_stamp = new \DateTime($event->dtend);
            $date->begin_date = $begin_stamp->format('Y-m-d');
            $date->begin_time = $begin_stamp->format('H:i:s');
            $date->end_date = $end_stamp->format('Y-m-d');
            $date->end_time = $end_stamp->format('H:i:s');
            $date->unique_id = $uid;
            $date->commit();
            if ($this->isValidUUID($uid)) {
                $date->_uuid = $uid;
                $date->commit();
            }
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