<?php

namespace Sunhill\InfoMarket\Tests\Feature;

class InfoMarketOfferingTest extends InfoMarketBase
{
    
    public function testGetOfferingsNoTree()
    {
        $test = $this->getMarket();
        $offering = $test->getOfferings();
        sort($offering);
        $this->assertEquals([
            'indexed.#.test',
            'infomarket.name',
            'infomarket.version',
            'some.?.test.?',
            'test.another',
            'test.item',
        ],$offering);
    }
    
    public function testGetFullOfferingsNoTree()
    {
        $test = $this->getMarket();
        $offering = $test->getFullOfferings();
        sort($offering);
        $this->assertEquals([
            'indexed.1.test',
            'indexed.2.test',
            'infomarket.name',
            'infomarket.version',
            'some.ab.test.cd',
            'some.ab.test.ef',
            'some.bc.test.cd',
            'some.bc.test.ef',
            'test.another',
            'test.item',
        ],$offering);
    }
    
    public function testGetOfferingsWithFilter()
    {
        $test = $this->getMarket();
        $offering = $test->getOfferings('test.*');
        sort($offering);
        $this->assertEquals([
            'test.another',
            'test.item',
        ],$offering);        
    }
    
    public function testGetFullOfferingsWithFilter()
    {
        $test = $this->getMarket();
        $offering = $test->getFullOfferings('test.*');
        sort($offering);
        $this->assertEquals([
            'test.another',
            'test.item',
        ],$offering);
    }
    
    public function testGetFullOfferingsWithFilterAndDepth1()
    {
        $test = $this->getMarket();
        $offering = $test->getFullOfferings('some.*',1);
        sort($offering);
        $this->assertEquals([
            'some.ab.',
            'some.bc.',
        ],$offering);
    }
    
    public function testGetFullOfferingsWithFilterAndDepth2()
    {
        $test = $this->getMarket();
        $offering = $test->getFullOfferings('some.*',2);
        sort($offering);
        $this->assertEquals([
            'some.ab.test.',
            'some.bc.test.',
        ],$offering);
    }
    
    public function testGetFullOfferingsWithFilterAndDepth3()
    {
        $test = $this->getMarket();
        $offering = $test->getFullOfferings('some.*',3);
        sort($offering);
        $this->assertEquals([
            'some.ab.test.cd',
            'some.ab.test.ef',
            'some.bc.test.cd',
            'some.bc.test.ef',
        ],$offering);
    }
    
}
