<?php

use Sunhill\InfoMarket\Market\ObjectLeaf;
use Sunhill\InfoMarket\Tests\InfoMarketTest;

class FakeObjectLeaf extends ObjectLeaf
{
    public $object;
    
    public $str = 'ABC';
    
    public $int = 123;
    
    public $float = 1.23;
    
    public function initObj()
    {
        $this->object = new FakeObjectLeaf();
        $this->object->str = 'DEF';
        $this->object->int = 456;
        $this->object->float = 4.56;
    }
    
    protected function getObjectValue(string $name, array $remaining)
    {
        switch ($name)
        {
            case 'str': return $this->str;
            case 'int': return $this->int;
            case 'float': return $this->float;
            case 'obj': return $this->object; 
        }
    }
   
    protected function setObjectValue(string $first, $value, $remaining)
    {
        switch ($first)
        {
            case 'str': $this->str = $value;
            case 'int': $this->int = $value;
            case 'float': $this->float = $value;
        }        
    }
    
}

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
}