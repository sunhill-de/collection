<?php

namespace Sunhill\Collection\Tiles\Information;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;
use Sunhill\Collection\Objects\Dates\Date;

class Calendar extends SunhillBladeResponse
{
    
    protected $template = 'collection::information.calendar';
    
    protected function getCalendarEntries()
    {
        $date_entries = Date::query()->where('begin_date','>=',now())->orderBy('begin_date')->limit(12)->get();
        
        $result = [];

        foreach ($date_entries as $entry) {
            $single_entry = new \StdClass();
            $date = new \DateTime($entry->begin_date);
            $single_entry->begin_date = $date->format('d.m.Y');
            if (strlen($entry->name) > 40) {
                $single_entry->name = substr($entry->name,0,40).'...';
            } else {
                $single_entry->name = $entry->name;                
            }
            $single_entry->begin_time = $entry->begin_time;
            $result[] = $single_entry;
        }
        
        return $result;
    }
    
    protected function prepareResponse()
    {
 //       parent::prepareResponse();
        
        $this->params['linktarget'] = "window.location = '/Information/Calendar';";
        $this->params['entries'] = $this->getCalendarEntries();
    }
    
}