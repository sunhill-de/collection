<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\ORM\Facades\Collections;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\InfoMarket\Market;
use Sunhill\ORM\Facades\InfoMarket;

class SemanticsItem extends OnDemandMarketeer
{

    protected function initializeMarketeer()
    {
        $semantics = InfoMarket::getSemantics();
        $this->addEntry('count',(new DynamicItem())->defineValue(count($semantics))->type('int')->semantic('Count'));
        foreach ($semantics as $unit => $class) {
            $this->addEntry($unit,new SemanticEntryItem($class));
        }
        
    }
            
}

