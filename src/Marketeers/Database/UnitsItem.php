<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\ORM\Facades\Collections;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\InfoMarket\Market;
use Sunhill\ORM\Facades\InfoMarket;

class UnitsItem extends OnDemandMarketeer
{

    protected function initializeMarketeer()
    {
        $units = InfoMarket::getUnits();
        $this->addEntry('count',(new DynamicItem())->defineValue(count($units))->type('int')->semantic('Count'));
        foreach ($units as $unit => $class) {
            $this->addEntry($unit,new UnitEntryItem($class));
        }
        
    }
            
}

