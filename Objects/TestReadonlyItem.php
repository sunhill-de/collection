<?php

namespace Sunhill\InfoMarket\Tests\Objects;

use Sunhill\InfoMarket\Market\Item;

class TestReadonlyItem extends Item
{
    
    public $value = 5;
    
    protected $metadata = [
        'unit'=>'None',
        'type'=>'Integer',
        'writeable'=>false
    ];
    
    protected function getItemValue()
    {
        return $this->value;
    }
        
}