<?php

namespace Sunhill\InfoMarket\Marketeers\Localhost;

use Sunhill\InfoMarket\Market\Item;

class LocalHostTimeItem extends Item
{
    protected $metadata = [
        'unit'=>'',
        'type'=>'Time',
        'semantic'=>'Time'
    ];  

    protected function getItemValue()
    {
        return "0.2";
    }

}  
