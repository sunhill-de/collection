<?php

use Sunhill\InfoMarket\Market\ObjectLeaf;
use Sunhill\InfoMarket\Tests\InfoMarketTest;
use Sunhill\InfoMarket\Tests\Objects\TestObjectLeaf as FakeObjectLeaf;

class ObjectLeafTest extends InfoMarketTest
{
    
    public function testSimpleObjectAccess()
    {
        $test = new FakeObjectLeaf();
        $this->assertEquals('ABC',$test->getValue(['str']));
        $this->assertEquals(123,$test->getValue(['int']));
        $this->assertEquals(1.23,$test->getValue(['float']));
    }
    
    public function testComplexObjectAccess()
    {
        $test = new FakeObjectLeaf();
        $test->initObj();
        $this->assertEquals('DEF',$test->getValue(['obj','str']));
        $this->assertEquals(456,$test->getValue(['obj','int']));
        $this->assertEquals(4.56,$test->getValue(['obj','float']));        
    }
    
    public function testSimpleObjectWrite()
    {
        $test = new FakeObjectLeaf();
        $test->setValue('XYZ',['str']);
        $this->assertEquals('XYZ',$test->str);
    }
    
    public function testComplexObjectWrite()
    {
        $test = new FakeObjectLeaf();
        $test->initObj();
        $test->setValue('XYZ',['obj','str']);
        $this->assertEquals('XYZ',$test->object->str);
        
    }
    
    public function testGetOfferNormal()
    {
        $test = new FakeObjectLeaf();
        $test->setName('test');
        
        $this->assertEquals(['test'],$test->getOffer());
    }
    
    public function testGetDeepOffer()
    {
        $test = new FakeObjectLeaf();
        $test->setName('test');
        
        $this->assertEquals(['test.str','test.int','test.float','test.obj'],$test->getDeepOffer());
        
    }
    
}