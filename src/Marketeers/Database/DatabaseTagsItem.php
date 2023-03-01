<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\Infomarket\Market\ArrayLeaf;
use Sunhill\ORM\Facades\Tags;

class DatabaseTagsItem extends ArrayLeaf
{
    protected $element_metadata = [
        'unit'=>'',
        'type'=>'Str',
        'semantic'=>'Branch'
    ];

    protected function getCount(string $filter): int
    {
        return Tags::getCount();
    }

    protected function getIndexValue(int $index, array $remains, string $order, string $filter)
    {
        return new DatabaseObjectsEntryItem($index);
    }
    
}

