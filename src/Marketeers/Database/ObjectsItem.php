<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\InfoMarket\Items\ArrayInfoMarketItem;
use Sunhill\ORM\Facades\Collections;
use Sunhill\ORM\Objects\ORMObject;

class ObjectsItem extends ArrayInfoMarketItem
{

    /**
     * Setup this item with the name 'classes'
     */
    public function __construct()
    {
        parent::__construct();
        $this->setName('objects');
    }
    
    /**
     * Return the current number of installed classes
     * @return int
     */
    protected function getCountValue(): int
    {
        return ORMObject::search()->count();
    }

    protected function getIndexedElement(int $index)
    {
        return new DatabaseClassesEntryItem($index);
    }
       
}

