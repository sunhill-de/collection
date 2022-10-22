<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Response\Response;

class FakeElement extends Element
{
    protected function doRoute(string $element, array $remains, string $credentials, Response &$response)
    {
        
    }
    
    protected function doGetOffer(string $filter, string $credentials, int $depth)
    {
        
    }
    
}

class ElementTest extends SunhillNoAppTestCase
{
    
    /**
     * Test the [has,set,get]Param mechanism
     */
    public function testParams()
    {
        $test = new FakeElement();
        $this->assertFalse($test->hasParam('test'));
        $test->addParam('test','TEST');
        $this->assertTrue($test->hasParam('test'));
        $this->assertEquals('TEST',$test->hasParam('test'));
    }
}