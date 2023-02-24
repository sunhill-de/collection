<?php

namespace Sunhill\InfoMarket\Marketeers\Localhost;

use Sunhill\InfoMarket\Market\Marketeer;

class LocalhostMarketeer extends Marketeer
{
   
    protected function getOffering(): array
    {
        return [
            'localhost.time'=>LocalhostTimeItem::class,
            'localhost.date'=>LocalhostDateItem::class,
            'localhost.datetime'=>LocalhostDateTimeItem::class,
        ];
    }

}  
