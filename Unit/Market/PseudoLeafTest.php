<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\PseudoLeaf;
use Sunhill\InfoMarket\Response\Response;

class FakePseudoLeaf extends PseudoLeaf
{

    public $value = 5;
    
    protected function doGetItemValue(array $remains, Response &$response)
    {
        return $remains[0]*2;
    }
    
    protected function doSetItemValue(array $remains, $value, Response &$response)
    {
        $this->value = $remains[0]*$value;
    }
  
    protected function isWriteable($response, array $remains = [])
    {
        return true;
    }
    
    
}

class PseudoLeafTest extends SunhillNoAppTestCase
{
    
    public function testGetValue()
    {
        $test = new FakePseudoLeaf();
        $response = new Response();
        $response->setElement('method','get');
        $this->assertTrue($this->callProtectedMethod($test,'doRoute',['test',[5],'anybody',&$response]));
        $this->assertEquals(10,$response->get('object')->value);        
    }
    
    public function testSetValue()
    {
        $test = new FakePseudoLeaf();
        $response = new Response();
        $response->setElement('method','set');
        $response->setElement('value',10);
        $this->assertTrue($this->callProtectedMethod($test,'doRoute',['test',[2],'anybody',&$response]));
        $this->assertEquals(20,$test->value);
    }
    
}