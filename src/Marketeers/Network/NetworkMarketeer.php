<?php

namespace Sunhill\InfoMarket\Marketeers\Network;

use Sunhill\InfoMarket\Market\Marketeer;

class NetworkMarketeer extends Marketeer
{
   
    protected function getOffering(): array
    {
        return [
          'network.current'=>MacPingItem::class
        ];
    }

}  
