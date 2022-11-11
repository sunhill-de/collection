<?php

namespace Sunhill\InfoMarket\Marketeers\Internal;

use Sunhill\InfoMarket\Market\Item;

class InfoMarketVersionItem extends Item
{
    protected $metadata = [
        'unit'=>'',
        'type'=>'Str',
        'semantic'=>'Name'
    ];  

    protected function getItemValue()
    {
        return "0.2";
    }

}  
