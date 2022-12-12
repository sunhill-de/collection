<?php

use Sunhill\InfoMarket\Market\Item;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;
use Sunhill\InfoMarket\Tests\Objects\TestSimpleItem as TestItem;

class ItemTest extends InfoMarketTest
{
    
    public function testOverwrite()
    {
        $test = new TestItem();
        $response = new Response();
        $this->assertEquals('None',$this->callProtectedMethod($test,'getUnit',[[],$response]));
    }
    
    public function testGetThisElementFail()
    {
        $test = new TestItem();
        $result = $test->getElement('A',['B','C']);
        $this->assertEquals(null,$result);        
    }
    
    public function testGetValue()
    {
        $test = new TestItem();
        $this->assertEquals(5,$test->getValue());
    }

    
    public function testSetValue()
    {
        $test = new TestItem();
        $test->setValue(6);
        $this->assertEquals(6,$test->getValue());
    }
    
}