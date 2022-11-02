<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\ArrayLeaf;
use Sunhill\InfoMarket\Response\Response;

class FakeSimpleArrayLeaf extends ArrayLeaf
{
    public $values = [2,4,6];
        
    public function __construct(int $mult = 1)
    {
        for ($i=0;$i<3;$i++) {
            $this->values[$i] *= $mult;
        }
    }
    
    protected function getCount(): int
    {
        return 3;
    }
    
    protected function getIndexValue(int $index, array $remains)
    {
        return $this->values[$index];
    }
    
    protected function setIndexValue(int $index, $value, array $remains)
    {
        $this->values[$index] = $value;
    }
}

class FakeComplexArrayLeaf extends ArrayLeaf
{

    protected function getCount(): int
    {
        return 3;
    }
    
    protected function getIndexValue(int $index, array $remains)
    {
        $result = new FakeSimpleArrayLeaf($index+1);
        return $result;
    }
    
}

class ArrayLeafTest extends SunhillNoAppTestCase
{
    
    public function testGetCount()
    {
        $test = new FakeSimpleArrayLeaf();
        $this->assertEquals(3,$test->getValue(['count']));
    }
    
    public function testGetIndex()
    {
        $test = new FakeSimpleArrayLeaf();
        $this->assertEquals(4,$test->getValue(['1']));
    }
    
    public function testSetIndex()
    {
        $test = new FakeSimpleArrayLeaf();
        $test->setValue(9,['1']);
        $this->assertEquals(9,$test->getValue(['1']));
    }
}
