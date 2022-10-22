<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Response\Response;

class FakeElement extends Element
{
    protected function doRoute(string $element, array $remains, string $credentials, Response &$response)
    {
        return true;
    }
    
    protected function doGetOffer(string $credentials, string $filter, int $depth)
    {
        
    }
 
    protected function routeFinished(string $credentials, Response &$response)
    {
        return false;
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
    
    public function testEmptyRoute()
    {
        $test = new FakeElement();
        $response = new Response();
        $this->assertFalse($test->route([],'anybody',$response));
    }
    
    public function testNonEmptyRoute()
    {
        $test = new FakeElement();
        $response = new Response();
        $this->assertTrue($test->route(['a'],'anybody',$response));        
    }
}