<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\Basic\Tests\SunhillAppTestCase;
use Sunhill\InfoMarket\Facades\InfoMarket;

use Sunhill\InfoMarket\Tests\Objects\TestMarketeer1;
use Sunhill\InfoMarket\Tests\Objects\TestMarketeer2;

class SimpleTest extends SunhillAppTestCase
{
        
    public function testSimpleString()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $item = InfoMarket::getItem('infomarket.name','anybody','object');
        $this->assertEquals('InfoMarket',$item->value);
        $this->assertEquals('Str',$item->type);
        $this->assertEquals('Name',$item->semantic);
        $this->assertEquals('None',$item->unit);
        $this->assertFalse($item->writeable);
        $this->assertEquals('infomarket.name',$item->request);
    }
    
    public function testSimpleItem()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $item = InfoMarket::getItem('test.simple','anybody','object');
        $this->assertEquals(5,$item->value);
        InfoMarket::setItem('test.simple',10,'anybody','object');
        $item = InfoMarket::getItem('test.simple','anybody','object');
        $this->assertEquals(10,$item->value);
    }
    
    public function testItemFail()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $item = InfoMarket::getItem('test.notexisting','anybody','object');
        $this->assertEquals('FAILED',$item->result);
        $item = InfoMarket::getItem('not.existing','anybody','object');
        $this->assertEquals('FAILED',$item->result);
    }
    
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