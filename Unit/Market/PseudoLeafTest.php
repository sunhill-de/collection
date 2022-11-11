<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\PseudoLeaf;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;

class FakePseudoLeaf extends PseudoLeaf
{

    public $values = ['A'=>1,'B'=>2,'C'=>3];
    
    protected function getSubroutedValue(string $first, array $remains)
    {
        return $this->values[$first];    
    }
    
    protected function setSubroutedValue(string $first, $value, array $remains)
    {
        $this->values[$first] = $value;
    }
}

class PseudoLeafTest extends InfoMarketTest
{
    
    public function testGetValuePass()
    {
        $test = new FakePseudoLeaf();
        $this->assertEquals(1,$test->getValue(['A']));
    }
    
    public function testGetValueFail()
    {
        $test = new FakePseudoLeaf();
        $this->assertEquals(null,$test->getValue([]));
    }
    
    public function testSetValue()
    {
        $test = new FakePseudoLeaf();
        $test->setValue('Z',['A']);
        $this->assertEquals('Z',$test->getValue(['A']));
    }
    
}