<?php

use Sunhill\InfoMarket\Market\Branch;
use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;

class BranchItem1 extends Element
{
    public $value = 123;
    
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
    
    protected function getThisOffer(int $depth)
    {
        return ['a.b.c'];
    }
    
}

class BranchItem2 extends Element
{
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
    
    protected function getThisOffer(int $depth)
    {
        return ['d.e.f'];
    }
    
}

class BranchTest extends InfoMarketTest
{
    
    public function testAddBranch()
    {
        $test = new Branch();
        
        $this->assertFalse($test->hasSubbranch('test'));
        $test->addSubbranch('test');
        $this->assertTrue($test->hasSubbranch('test'));
        $this->assertEquals('test',$test->getSubbranch('test')->getName());
    }
    
    public function testProcessThisOffer1()
    {
        $test = new Branch();
        $test->setName('test');
        
        $item = new BranchItem1();
        $test->processThisOffer('item',[],$item);
        $subbranch = $test->getSubbranch('item');
        $this->assertEquals('item',$subbranch->getName());
        $this->assertEquals(123,$this->callProtectedMethod($subbranch,'getValue'));
    }
    
    public function testProcessThisOffer2()
    {
        $test = new Branch();
        $test->setName('test');
        
        $item = new BranchItem1();
        $test->processThisOffer('sub',['subsub','item'],$item);
        $subbranch = $test->getSubbranch('sub')->getSubbranch('subsub')->getSubbranch('item');
        $this->assertEquals('item',$subbranch->getName());
        $this->assertEquals(123,$this->callProtectedMethod($subbranch,'getValue'));
    }
    
    public function testGetElementPass()
    {
        $test = new Branch();
        $test->setName('test');
        
        $test->addSubbranch('element');
        
        $result = $this->callProtectedMethod($test, 'getElement', ['element',[]]);
        
        $this->assertEquals('element',$result->element->getName());
    }

    public function testGetElementPass2()
    {
        $test = new Branch();
        $test->setName('test');
        $test->addSubbranch('sub');
        $sub = $this->callProtectedMethod($test, 'getElement', ['sub',[]]);
        $sub->element->addSubbranch('subsub');
        
        $result = $this->callProtectedMethod($test, 'getElement', ['sub.subsub',[]]);
        
        
        $this->assertEquals('subsub',$result->element->getName());
    }
    
    public function testGetElementFail()
    {
        $test = new Branch();
        $test->setName('test');
        $test->addSubbranch('sub');
        $sub = $this->callProtectedMethod($test, 'getElement', ['sub',[]]);
        $sub->element->addSubbranch('subsub');
        
        $result = $this->callProtectedMethod($test, 'getElement', ['sub.doesntexist',[]]);
        $this->assertFalse($result);
        $result = $this->callProtectedMethod($test, 'getElement', ['doesntexist.subsub',[]]);
        $this->assertFalse($result);
    }
    
    public function testGetThisMetadata()
    {
        $test = new Branch();
        $test->setName('test');
        $response = new Response();
        $this->assertTrue($test->getMetadata($response));
        $this->assertEquals('Branch',$response->getElement('type'));
    }

    public function testGetNodes1()
    {
        $test = new Branch();
        $test->addSubbranch('sub1');
        $test->addSubbranch('sub2');
        $test->addSubbranch('sub3');
        $result = $test->collectNodes();
        $this->assertEquals(['sub1','sub2','sub3'],$result);
    }

    public function testGetNodes2()
    {
        $test = new Branch();
        $test->addSubbranch('sub1');
        $test->addSubbranch('sub2')->setReadRestriction('admin');
        $test->addSubbranch('sub3');
        $result = $test->collectNodes('anybody');
        $this->assertEquals(['sub1','sub3'],$result);
    }
}