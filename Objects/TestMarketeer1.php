<?php

namespace Sunhill\InfoMarket\Tests\Objects;

use Sunhill\InfoMarket\Market\Marketeer;

class TestMarketeer1 extends Marketeer
{
    
    protected function getOffering(): array
    {
        return [
            'test.simple'=>TestSimpleItem::class,
        ];
    }
    
}