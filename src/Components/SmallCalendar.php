<?php

namespace Sunhill\Collection\Components;

use Illuminate\View\Component;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Objects;
use Sunhill\Visual\Facades\Dialogs;
use Sunhill\ORM\Facades\InfoMarket;
use Sunhill\Collection\Objects\Dates\Date;

class SmallCalendar extends Component
{
    
    protected $entries;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($entries)
    {
        $this->entries = $entries;
    }

    protected function getStartDate()
    {
        $result = new \DateTime();
        return $result->format('Y-m-d 00:00:00');
    }


    protected function getDateName($input)
    {
        $date = new \DateTime($input);
        $date->setTime(0,0);
        
        $now = new \DateTime();
        $now->setTime(0,0);
        
        $diff = $now->diff($date);
        switch ($diff->days) {
            case 0:
                return __('Today');
            case 1:
                return __('Tomorrow');
            case 2:
                return __('Day after tomorrow');
            default:
                return $date->format('d.m.Y');
        }
    }
    
    protected function getDateEntries($date)
    {
        $result = [];
        foreach ($date as $entry) {
           $single_entry = new \StdClass();
           
           if (strlen($entry->name) > 40) {
               $single_entry->name = substr($entry->name,0,40).'...';
           } else {
               $single_entry->name = $entry->name;
           }
           if ($entry->begin_time <> $entry->end_time) {
               $single_entry->time = substr($entry->begin_time,0,5).'-'.substr($entry->end_time,0,5);
           }
           $result[] = $single_entry; 
        }
        return $result;
    }
    
    protected function getCalendarEntries()
    {
        $start_date = $this->getStartDate();
        
        $date_entries = Date::query()->where('begin_date','>=',$start_date)->orderBy('begin_date')->limit($this->entries)->get();
        $grouped_dates = $date_entries->groupBy(function($item,int $key) {
           $date = new \DateTime($item->begin_date);
           return $date->format('Y-m-d');
        });        
        $result = [];
        foreach ($grouped_dates as $key => $date) {
            $entry = new \StdClass();
            $entry->date = $this->getDateName($key);
            $entry->entries = $this->getDateEntries($date);
            $result[] = $entry;
        }
        
        return $result;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('collection::information.calendar', [
            'dates'=> $this->getCalendarEntries()
        ]);
    }
}
