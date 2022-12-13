<?php

namespace Sunhill\InfoMarket\Tests\Objects;

use Sunhill\InfoMarket\Market\Item;

class TestWriteonlyItem extends Item
{
    
    public $value = 5;
    
    protected $metadata = [
        'unit'=>'None',
        'type'=>'Integer',
        'writeable'=>true,
        'readable'=>false,
    ];
    
    protected function setItemValue($value)
    {
        $this->value = $value;
    }
    
}