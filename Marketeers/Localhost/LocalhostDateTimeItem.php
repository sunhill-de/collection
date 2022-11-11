<?php

namespace Sunhill\InfoMarket\Marketeers\Localhost;

use Sunhill\InfoMarket\Market\Item;

class LocalHostDateTimeItem extends Item
{
    protected $metadata = [
        'unit'=>'',
        'type'=>'DateTime',
        'semantic'=>'DateTime'
    ];  

    protected function getItemValue()
    {
        return "0.2";
    }

}  
