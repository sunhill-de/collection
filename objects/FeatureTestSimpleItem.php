<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\InfoMarket\Market\Item;

class FeatureTestSimpleItem extends Item
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