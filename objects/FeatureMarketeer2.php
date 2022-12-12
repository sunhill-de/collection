<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\InfoMarket\Market\Marketeer;

class FeatureMarketeer2 extends Marketeer
{
    
    protected function getOffering(): array
    {
        return [
            'test.another'=>FeatureTestAnotherItem::class,
        ];
    }
    
}