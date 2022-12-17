<?php

namespace Sunhill\InfoMarket\Tests\Objects;

use Sunhill\InfoMarket\Market\Marketeer;

class TestMarketeer2 extends Marketeer
{
    
    protected function getOffering(): array
    {
        return [
            'test.another'=>TestAnotherItem::class,
            'array.simple'=>TestSimpleArrayLeaf::class,
            'array.complex'=>TestComplexArrayLeaf::class,
            'object.test'=>TestObjectLeaf::class,
//            'object.complex'=>TestObbjectArrayLeaf::class,
        ];
    }
    
}