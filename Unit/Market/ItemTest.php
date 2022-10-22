<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Item;
use Sunhill\InfoMarket\Response\Response;

class FakeItem extends Item
{
    protected $metadata = [
        'unit'=>'C',
        'type'=>'Float'
    ];  
    
    protected function doGetItemValue(Response &$response, array $remains = [])
    {
        
    }
    
    protected function doSetItemValue($value, Response &$response, array $remains = [])
    {
        
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
    
}