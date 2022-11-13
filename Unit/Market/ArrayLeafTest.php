<?php

use Sunhill\InfoMarket\Market\ArrayLeaf;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;

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

    protected $values = [];
    
    public function __construct()
    {
        $this->values[] = new FakeSimpleArrayLeaf(1);    
        $this->values[] = new FakeSimpleArrayLeaf(2);
        $this->values[] = new FakeSimpleArrayLeaf(3);
    }
    
    protected function getCount(): int
    {
        return 3;
    }
    
    protected function getIndexValue(int $index, array $remains)
    {
        return $this->values[$index];
    }
    
}

class ArrayLeafTest extends InfoMarketTest
{
    
    public function testSimpleGetCount()
    {
        $test = new FakeSimpleArrayLeaf();
        $this->assertEquals(3,$test->getValue(['count']));
    }
    
    public function testSimpleGetIndex()
    {
        $test = new FakeSimpleArrayLeaf();
        $this->assertEquals(4,$test->getValue(['1']));
    }
    
    public function testSimpleSetIndex()
    {
        $test = new FakeSimpleArrayLeaf();
        $test->setValue(9,['1']);
        $this->assertEquals(9,$test->getValue(['1']));
    }
    
    public function testComplexGetCount()
    {
        $test = new FakeComplexArrayLeaf();
        $this->assertEquals(3,$test->getValue(['1','count']));
    }
    
    public function testComplexGetIndex()
    {
        $test = new FakeComplexArrayLeaf();
        $this->assertEquals(6,$test->getValue(['0','2']));        
        $this->assertEquals(8,$test->getValue(['1','1']));
        $this->assertEquals(6,$test->getValue(['2','0']));
    }

    public function testComplexSetIndex()
    {
        $test = new FakeComplexArrayLeaf();
        $test->setValue('A',['0','2']);
        $test->setValue('B',['1','1']);
        $test->setValue('C',['2','0']);
        $this->assertEquals('A',$test->getValue(['0','2']));
        $this->assertEquals('B',$test->getValue(['1','1']));
        $this->assertEquals('C',$test->getValue(['2','0']));
    }
    
    public function testGetOfferNormal()
    {
        $test = new FakeSimpleArrayLeaf();
        $test->setName('test');
        
        $this->assertEquals(['test'],$test->getOffer());
    }
    
    public function testGetDeepOffer()
    {
        $test = new FakeSimpleArrayLeaf();
        $test->setName('test');
        
        $this->assertEquals(['test.count','test.0','test.1','test.2'],$test->getDeepOffer());
        
    }
}
