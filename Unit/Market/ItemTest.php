<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Item;
use Sunhill\InfoMarket\Response\Response;

class FakeItem extends Item
{
    public $value = 5;
    
    protected $metadata = [
        'unit'=>'C',
        'type'=>'Float',
        'writeable'=>true
    ];  
    
    protected function doGetItemValue(Response &$response)
    {
        return $this->value;
    }
    
    protected function doSetItemValue($value, Response &$response)
    {
        $this->value = $value;
    }
    
}

class ItemTest extends SunhillNoAppTestCase
{
    
    public function testOverwrite()
    {
        $test = new FakeItem();
        $response = new Response();
        $this->assertEquals('C',$this->callProtectedMethod($test,'getUnit',[[],$response]));
    }
    
    public function testGetValue()
    {
        $test = new FakeItem();
        $response = new Response();
        $response->setElement('method','get');
        $this->assertTrue($this->callProtectedMethod($test,'routeFinished',['anybody',&$response]));
        $this->assertEquals(5,$response->get('object')->value);
    }
    
    public function testSetValue()
    {
        $test = new FakeItem();
        $response = new Response();
        $response->setElement('method','set'); 
        $response->setElement('value',10);
        $this->assertTrue($this->callProtectedMethod($test,'routeFinished',['anybody',&$response]));
        $this->assertEquals(10,$test->value);
    }
}