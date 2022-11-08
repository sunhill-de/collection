<?php

namespace Sunhill\InfoMarket\Marketeers\Internal;

use Sunhill\InfoMarket\Market\Marketeer;

class InternalMarketeer extends Marketeer
{
   
    protected function getOffering(): array
    {
        return [
          'infomarket.name'=>InfoMarketNameItem::class,
          'infomarket.version'=>InfoMarketVersionItem::class
        ];
    }

}  
