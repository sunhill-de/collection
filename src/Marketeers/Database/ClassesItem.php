<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class ClassesItem extends OnDemandMarketeer
{

    protected function initializeMarketeer()
    {
     
        $classes = Classes::getAllClasses();
        $this->addEntry('count',(new DynamicItem())->defineValue(count($classes))->type('int')->semantic('Count'));
        foreach ($classes as $class) {
            $this->addEntry($class->name,new ClassEntryItem($class));
        }
        
    }
            
}

