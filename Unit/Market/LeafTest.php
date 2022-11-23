<?php

use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Market\Leaf;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;

class FakeLeaf extends Leaf
{

    protected function getThisMetadata(Response &$response, array $remains = [] )
    {
    }
    
    protected function getThisValue(array $remains = [])
    {
    }
    
    protected function setThisValue($value, array $remains = [])
    {
    }
    
    protected function isThisAllowedToRead(string $credentials, array $remains = []): bool
    {
    }
    
    protected function isThisAllowedToWrite(string $credentials, array $remains = []): bool
    {
    }
       
}

class LeafTest extends InfoMarketTest
{
    
    public function testGetElement()
    {
        $test = new FakeLeaf();
        $result = $test->getElement('next',[]);
        $this->assertEquals($test,$result->element);
    }
    
    public function testGetOffer()
    {
        $test = new FakeLeaf();
        $test->setName('AA');
        $result = $test->getOffer();
        $this->assertEquals(['AA'],$result);
    }
    
    public function testGetDeepOffer()
    {
        $test = new FakeLeaf();
        $test->setName('AA');
        $result = $test->getDeepOffer();
        $this->assertEquals(['AA'],$result);
    }
    
}