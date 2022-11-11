<?php

use Sunhill\InfoMarket\Market\Branch;
use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;

class BranchItem1 extends Element
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
        $element = new Branch();
        $element->setName('test');
        
        $this->assertFalse($test->hasSubbranch('test'));
        $test->addSubbranch($element);
        $this->assertTrue($test->hasSubbranch('test'));
        $this->assertEquals('test',$test->getSubbranch('test')->getName());
    }
    
    public function testMergeBranch()
    {
        $test = new Branch();
        
        $element1 = new Branch();
        $element1->setName('test');
        $subelement1 = new Branch();
        $subelement1->setName('subtest1');
        $element1->addSubbranch($subelement1);
        
        $element2 = new Branch();
        $element2->setName('test');
        $subelement2 = new Branch();
        $subelement2->setName('subtest2');
        $element2->addSubbranch($subelement2);
        
        $test->addSubbranch($element1);
        $test->addSubbranch($element2);
        
        $this->assertTrue($test->hasSubbranch('test'));
        $subbranch = $test->getSubbranch('test');
        $this->assertTrue($subbranch->hasSubbranch('subtest1'));
        $this->assertTrue($subbranch->hasSubbranch('subtest2'));
    }
    
    public function testGetElementPass()
    {
        $test = new Branch();
        $test->setName('test');
        $element = new Branch();
        $element->setName('element');
        $test->addSubbranch($element);
        
        $result = $this->callProtectedMethod($test, 'getElement', ['element',[]]);
        
        $this->assertEquals($element,$result->element);
    }

    public function testGetElementPass2()
    {
        $test = new Branch();
        $test->setName('test');
        $element = new Branch();
        $element->setName('element');
        $subelement = new Branch();
        $subelement->setName('subelement');
        $element->addSubbranch($subelement);
        $test->addSubbranch($element);
        
        $result = $this->callProtectedMethod($test, 'getElement', ['element',['subelement']]);
        
        $this->assertEquals($subelement,$result->element);
    }
    
    public function testGetElementFail()
    {
        $test = new Branch();
        $test->setName('test');
        $element = new Branch();
        $element->setName('element');
        $test->addSubbranch($element);
        
        $result = $this->callProtectedMethod($test, 'getElement', ['notexisting',[]]);
        
        $this->assertEquals(null,$result);
    }
    
    public function testGetThisMetadata()
    {
        $test = new Branch();
        $test->setName('test');
        $response = new Response();
        $this->assertTrue($test->getMetadata($response));
        $this->assertEquals('Branch',$response->getElement('type'));
    }

    public function testGetThisMetadataFail()
    {
        $test = new Branch();
        $test->setName('test');
        $response = new Response();
        $this->assertFalse($test->getMetadata($response,['some']));
    }
    
    public function testGetOffer()
    {
        $test = new Branch();
        $element1 = new BranchItem1();
        $element1->setName('a');
        $element2 = new BranchItem2();
        $element2->setName('d');
        
        $test->addSubbranch($element1);
        $test->addSubbranch($element2);
        
        $result = $test->getOffer();
        sort($result);
        $this->assertEquals(['a.b.c','d.e.f'],$result);
    }
}