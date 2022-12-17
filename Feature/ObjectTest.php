<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\Basic\Tests\SunhillAppTestCase;
use Sunhill\InfoMarket\Facades\InfoMarket;

use Sunhill\InfoMarket\Tests\Objects\TestMarketeer1;
use Sunhill\InfoMarket\Tests\Objects\TestMarketeer2;

class ObjectTest extends SunhillAppTestCase
{
        
    public function testSimpleObject()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $item = InfoMarket::getItem('object.test.str','anybody','object');
        $this->assertEquals('ABC',$item->value);
    }       
    
}