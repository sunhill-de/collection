<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\InfoMarket\Market\Marketeer;

class FeatureMarketeer1 extends Marketeer
{
    
    protected function getOffering(): array
    {
        return [
            'test.simple'=>FeatureTestSimpleItem::class,
        ];
    }
    
}