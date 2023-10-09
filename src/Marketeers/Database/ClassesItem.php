<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\InfoMarket\Items\ArrayInfoMarketItem;

class ClassesItem extends ArrayInfoMarketItem
{

    /**
     * Setup this item with the name 'classes'
     */
    public function __construct()
    {
        parent::__construct();
        $this->setName('classes');
    }
    
    /**
     * Return the current number of installed classes
     * @return int
     */
    protected function getCountValue(): int
    {
        return Classes::getClassCount();
    }

    protected function getIndexedElement(int $index)
    {
        return new DatabaseClassesEntryItem($index);
    }
       
}

