<?php

namespace Sunhill\InfoMarket\Tests\Objects;

use Sunhill\InfoMarket\Market\Item;

class TestSimpleItem extends Item
{
    
    public $value = 5;
    
    protected $metadata = [
        'unit'=>'None',
        'type'=>'Integer',
        'writeable'=>true
    ];
    
    protected function getItemValue()
    {
        return $this->value;
    }
    
    protected function setItemValue($value)
    {
        $this->value = $value;
    }
    
}