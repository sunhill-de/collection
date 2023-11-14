<?php

namespace Sunhill\Collection\Marketeers\Network;


use Sunhill\ORM\InfoMarket\Marketeer;

class NetworkMarketeer extends Marketeer
{
   
    protected function getOffering(): array
    {
        return [
          'network.current'=>MacPingItem::class
        ];
    }

}  
