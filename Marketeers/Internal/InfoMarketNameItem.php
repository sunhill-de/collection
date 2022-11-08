<?php

namespace Sunhill\InfoMarket\Marketeers\Internal;

class InfoMarketNameItem extends Item
{
    protected $metadata = [
        'unit'=>'',
        'type'=>'String',
        'semantic'=>'Name'
    ];  

    protected function getItemValue()
    {
        return "InfoMarket";
    }

}  
