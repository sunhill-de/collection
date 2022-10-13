<?php

namespace Sunhill\InfoMarket\Tests\Feature;

class InfoMarketOfferingTest extends InfoMarketBase
{
    
    public function testGetOfferingsNoTree()
    {
        $test = $this->getMarket();
        $offering = $test->getOfferings();
        asort($offerings);
        $this->assertEquals([
            'indexed.#.test',
            'some.?.test.?',
            'test.another',
            'test.item',
        ],$offering);
    }
    
    public function testGetFullOfferingsNoTree()
    {
        $test = $this->getMarket();
        $offering = $test->getFullOfferings();
        asort($offerings);
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
        asort($offerings);
        $this->assertEquals([
            'test.another',
            'test.item',
        ],$offering);        
    }
    
    public function testGetFullOfferingsWithFilter()
    {
        $test = $this->getMarket();
        $offering = $test->getFullOfferings('test.*');
        asort($offerings);
        $this->assertEquals([
            'test.another',
            'test.item',
        ],$offering);
    }
    
    public function testGetFullOfferingsWithFilterAndDepth1()
    {
        $test = $this->getMarket();
        $offering = $test->getFullOfferings('some.*',1);
        asort($offerings);
        $this->assertEquals([
            'some.ab.',
            'some.bc.',
        ],$offering);
    }
    
    public function testGetFullOfferingsWithFilterAndDepth1()
    {
        $test = $this->getMarket();
        $offering = $test->getFullOfferings('some.*',2);
        asort($offerings);
        $this->assertEquals([
            'some.ab.test.',
            'some.bc.test.',
        ],$offering);
    }
    
    public function testGetFullOfferingsWithFilterAndDepth3()
    {
        $test = $this->getMarket();
        $offering = $test->getFullOfferings('some.*',3);
        asort($offerings);
        $this->assertEquals([
            'some.ab.test.cd',
            'some.ab.test.ef',
            'some.bc.test.cd',
            'some.bc.test.ef',
        ],$offering);
    }
    
}
