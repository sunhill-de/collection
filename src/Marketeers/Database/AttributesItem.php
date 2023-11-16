<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\ORM\Facades\Collections;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Facades\Attributes;

class AttributesItem extends OnDemandMarketeer
{

    protected function initializeMarketeer()
    {
        $tags = Attributes::query()->get();
        $this->addEntry('count',(new DynamicItem())->defineValue(count($tags))->type('int')->semantic('Count'));
        foreach ($tags as $tag) {
            $this->addEntry($tag->name,new AttributeEntryItem($tag));
        }
        
    }
            
}

