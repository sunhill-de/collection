<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\Basic\Tests\SunhillAppTestCase;
use Sunhill\InfoMarket\Facades\InfoMarket;

use Sunhill\InfoMarket\Tests\Objects\TestMarketeer1;
use Sunhill\InfoMarket\Tests\Objects\TestMarketeer2;

class SimpleTest extends SunhillAppTestCase
{
        
    public function testCrossBranch()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $item1 = InfoMarket::getItem('test.simple','anybody','object');
        $item2 = InfoMarket::getItem('test.another','anybody','object');
        $this->assertEquals(5,$item1->value);
        $this->assertEquals(5,$item2->value);
        InfoMarket::setItem('test.simple',10,'anybody','object');
        $item1 = InfoMarket::getItem('test.simple','anybody','object');
        $item2 = InfoMarket::getItem('test.another','anybody','object');
        $this->assertEquals(10,$item1->value);
        $this->assertEquals(5,$item2->value);        
    }
    
    public function testList()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $list = InfoMarket::getItemList(['test.simple','test.another'],'anybody','object');
        $this->assertEquals(5,$list[0]->value);
        $list = InfoMarket::setItemList(['test.simple','test.another'],10,'anybody','object');
        $list = InfoMarket::getItemList(['test.simple','test.another'],'anybody','object');
        $this->assertEquals(10,$list[1]->value);
    }
}