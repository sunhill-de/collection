<?php

namespace Sunhill\Collection\Marketeers\Localhost;

use Sunhill\InfoMarket\Market\Item;

class LocalHostDateItem extends Item
{
    protected $metadata = [
        'unit'=>'',
        'type'=>'Date',
        'semantic'=>'Date'
    ];  

    protected function getItemValue()
    {
        return "0.2";
    }

}  
