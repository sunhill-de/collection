<?php

use Sunhill\InfoMarket\Market\ArrayLeaf;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;
use Sunhill\InfoMarket\InfoMarketException;

class FakeSimpleArrayLeaf extends ArrayLeaf
{
    public $values = [2,4,6];
        
    public function __construct(int $mult = 1)
    {
        for ($i=0;$i<3;$i++) {
            $this->values[$i] *= $mult;
        }
    }
    
    protected function getCount(string $filter): int
    {
        if ($filter == 'great') {
            return 2;
        } else {
            return 3;
        }
    }
    
    protected function getIndexValue(int $index, array $remains, string $order, string $filter)
    {
        if ($filter == 'great') {
            $index++;
        }
        if ($order == 'index') {
            return $this->values[$index];
        } else if ($order == 'reverse') {
            return $this->values[2-$index];
        }
    }
    
    protected function setIndexValue(int $index, $value, array $remains, string $order, string $filter)
    {
        $this->values[$index] = $value;
    }
    
    protected function getAllowedSort(): array
    {
        return ['reverse'];
    }
    
    protected function getAllowedFilter(): array
    {
        return ['great'];
    }
    
    public function pubHasField(&$remains, $test) 
    {
        return $this->hasField($remains, $test);
    }
    
    public function pubCheckFields(&$remains, &$index, &$order, &$filter) {
        return $this->checkFields($remains, $index, $order, $filter);    
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
    
    protected function getCount(string $filter): int
    {
        return 3;
    }
    
    protected function getIndexValue(int $index, array $remains, string $order, string $filter)
    {
        return $this->values[$index];
    }
    
}

class ArrayLeafTest extends InfoMarketTest
{
    
    /**
     * @dataProvider hasFieldProvider
     * @param unknown $remains
     * @param unknown $field
     * @param unknown $expect
     */
    public function testHasField($remains, $field, $expect)
    {
        $test = new FakeSimpleArrayLeaf();
        $result = $test->pubHasField($remains, $field);
        $this->assertEquals($expect, $result);
    }
    
    public function hasFieldProvider()
    {
        return [
            [['by_test'],'by_','test'],
            [['bytest'],'by_',false]
        ];    
    }
    
    /**
     * @dataProvider checkFieldProvider
     */
    public function testCheckField($remains, $index, $order, $filter, $except)
    {
        if ($except) {
            $this->expectException(InfoMarketException::class);
        }
        $test = new FakeSimpleArrayLeaf();
        
        $result = $test->pubCheckFields($remains, $real_index, $real_order, $real_filter);
        $this->assertEquals($index, $real_index);
        $this->assertEquals($order, $real_order);
        $this->assertEquals($filter, $real_filter);        
    }
    
    public function checkFieldProvider()
    {
        return [
           [['count'],'count','index','',false], 
           [['all'],'all','index','',false],
           [['count','something'],'','','',true],
           [['by_reverse','count'],'count','reverse','',false],
           [['by_something','count'],'','','',true],
           [['by_reverse','where_great','count'],'count','reverse','great',false],
           [['where_great','by_reverse','count'],'count','reverse','great',false],
           [['1'],'1','index','',false],
           [['-1'],'1','','',true],
           [['4'],'1','','',true],
        ];    
    }
    
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
    
    public function testSimpleGetIndexWithOrder()
    {
        $test = new FakeSimpleArrayLeaf();
        $this->assertEquals(4,$test->getValue(['by_reverse','1']));
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
    
}
