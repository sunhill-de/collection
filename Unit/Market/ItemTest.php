<?php

use Sunhill\InfoMarket\Market\Item;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;

class FakeItem extends Item
{
    public $value = 5;
    
    protected $metadata = [
        'unit'=>'C',
        'type'=>'Float',
        'writeable'=>true
    ];  
    
    protected function getItemValue()
    {
        return $this->value;
    }
    
    protected function setItemValue($value)
    {
        $this->value = $value;
    }
    
}

class ItemTest extends InfoMarketTest
{
    
    public function testOverwrite()
    {
        $test = new FakeItem();
        $response = new Response();
        $this->assertEquals('C',$this->callProtectedMethod($test,'getUnit',[[],$response]));
    }
    
    public function testGetThisElementFail()
    {
        $test = new FakeItem();
        $result = $test->getElement('A',['B','C']);
        $this->assertEquals(null,$result);        
    }
    
    public function testGetValue()
    {
        $test = new FakeItem();
        $this->assertEquals(5,$test->getValue());
    }

    
    public function testSetValue()
    {
        $test = new FakeItem();
        $test->setValue(6);
        $this->assertEquals(6,$test->getValue());
    }
    
}