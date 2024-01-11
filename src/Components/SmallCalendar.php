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

    protected function getCalendarEntries()
    {
        $date_entries = Date::query()->where('begin_date','>=',now())->orderBy('begin_date')->limit($this->entries)->get();
        
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
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('collection::information.calendar', [
            'entries'=> $this->getCalendarEntries()
        ]);
    }
}
