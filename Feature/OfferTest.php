<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\Basic\Tests\SunhillAppTestCase;
use Sunhill\InfoMarket\Facades\InfoMarket;

use Sunhill\InfoMarket\Tests\Objects\TestMarketeer1;
use Sunhill\InfoMarket\Tests\Objects\TestMarketeer2;

class OfferTest extends SunhillAppTestCase
{
        
    public function testGetOffer()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $list = InfoMarket::getOffer(true, 'array');
        sort($list);
        $this->assertTrue(in_array('test.simple',$list));
        $this->assertTrue(in_array('array.simple',$list));
        $this->assertFalse(in_array('array.simple.count',$list));
        $this->assertTrue(in_array('object.test',$list));
        $this->assertFalse(in_array('object.test.str',$list));
    }
    
    public function testGetNodesRoot()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $nodes = InfoMarket::getNodes("", "object", "anybody");
        
        $this->assertTrue(in_array('test',$nodes));
        $this->assertTrue(in_array('array',$nodes));
        $this->assertTrue(in_array('object',$nodes));
    }
    
    public function testGetNodesDeep1()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $nodes = InfoMarket::getNodes("test", "object", "anybody");
        $this->assertEquals(2,count($nodes));
        $this->assertTrue(in_array('simple',$nodes));
        $this->assertTrue(in_array('another',$nodes));
    }
    
    public function testGetNodesDeep2()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $nodes = InfoMarket::getNodes("array.simple", "object", "anybody");
        $this->assertTrue(in_array('count',$nodes));
        $this->assertTrue(in_array('all',$nodes));
        $this->assertTrue(in_array('0',$nodes));
        $this->assertTrue(in_array('1',$nodes));
        $this->assertTrue(in_array('2',$nodes));
    }
    
    public function testGetNodesDeep3()
    {
        InfoMarket::installMarketeer(TestMarketeer1::class);
        InfoMarket::installMarketeer(TestMarketeer2::class);
        $nodes = InfoMarket::getNodes("object.test", "object", "anybody");
        $this->assertTrue(in_array('str',$nodes));
        $this->assertTrue(in_array('int',$nodes));
        $this->assertTrue(in_array('float',$nodes));
    }
    
}