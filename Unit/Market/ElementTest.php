<?php

use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;

class FakeElement extends Element
{
    public $value = 5;
    
    protected function getThisElement(string $next, array $remains)
    {
        return $this;
    }
    
    protected function getThisMetadata(Response &$response, array $remains = [] )
    {
        $response->unit(' ')->semantic('name');        
    }
    
    protected function getThisValue(array $remains = [])
    {
        return $this->value;    
    }
    
    protected function setThisValue($value, array $remains = [])
    {
        $this->value = $value;        
    }
    
    protected function isThisAllowedToRead(string $credentials, array $remains = []): bool
    {
        return true;
    }
    
    protected function isThisAllowedToWrite(string $credentials, array $remains = []): bool
    {
        return false;
    }
    
    protected function getThisOffer()
    {
        return ['a.b.c'];
    }
    
}

class ElementTest extends InfoMarketTest
{
    
    public function testWrappers()
    {
        $test = new FakeElement();
        $response = new Response();
        $test->getMetadata($response,[]);
        $this->assertEquals(true,$test->isAllowedToRead('anybody',[]));
        $this->assertEquals(false,$test->isAllowedToWrite('anybody',[]));
        $this->assertEquals(5,$test->getValue([]));
        $test->setValue(6,[]);
        $this->assertEquals(6,$test->value);
        $this->assertEquals(['a.b.c'],$test->getOffer());
    }
}