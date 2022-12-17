<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\Basic\Tests\SunhillAppTestCase;
use Sunhill\InfoMarket\Facades\InfoMarket;

use Sunhill\InfoMarket\Tests\Objects\TestMarketeer1;
use Sunhill\InfoMarket\Tests\Objects\TestMarketeer2;

class ArrayTest extends SunhillAppTestCase
{
        
    public function testSimpleGetCount()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $item = InfoMarket::getItem('array.simple.count','anybody','object');
        $this->assertEquals(3,$item->value);
    }
    
    public function testSimpleGetElement()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $item = InfoMarket::getItem('array.simple.2','anybody','object');
        $this->assertEquals(6,$item->value);
    }
    
    public function testComplexGetCount1()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $item = InfoMarket::getItem('array.complex.count','anybody','object');
        $this->assertEquals(3,$item->value);
    }
    
    public function testComplexGetCount2()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $item = InfoMarket::getItem('array.complex.1.count','anybody','object');
        $this->assertEquals(3,$item->value);
    }

    public function testComplexGetElement()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $item = InfoMarket::getItem('array.complex.1.1','anybody','object');
        $this->assertEquals(8,$item->value);
    }
    
    
}