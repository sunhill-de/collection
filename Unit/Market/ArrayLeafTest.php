<?php

use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;
use Sunhill\InfoMarket\InfoMarketException;

use Sunhill\InfoMarket\Tests\Objects\TestSimpleArrayLeaf;
use Sunhill\InfoMarket\Tests\Objects\TestComplexArrayLeaf;

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
        $test = new TestSimpleArrayLeaf();
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
        $test = new TestSimpleArrayLeaf();
        
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
        $test = new TestSimpleArrayLeaf();
        $this->assertEquals(3,$test->getValue(['count']));
    }
    
    public function testSimpleGetIndex()
    {
        $test = new TestSimpleArrayLeaf();
        $this->assertEquals(4,$test->getValue(['1']));
    }
    
    public function testSimpleGetIndexWithOrder()
    {
        $test = new TestSimpleArrayLeaf();
        $this->assertEquals(2,$test->getValue(['by_reverse','2']));
    }
    
    public function testSimpleGetIndexWithFilter()
    {
        $test = new TestSimpleArrayLeaf();
        $this->assertEquals(4,$test->getValue(['where_great','0']));
    }
    
    public function testSimpleGetIndexWithBoth()
    {
        $test = new TestSimpleArrayLeaf();
        $this->assertEquals(4,$test->getValue(['by_reverse','where_great','1']));
        $this->assertEquals(6,$test->getValue(['by_reverse','where_great','0']));
    }
    
    public function testIndexException()
    {
        $this->expectException(InfoMarketException::class);
        $test = new TestSimpleArrayLeaf();
        $test->getValue(['where_great','2']);        
    }
    
    public function testGetAll()
    {
        $test = new TestSimpleArrayLeaf();
        $result = $test->getValue(['all']);
        $this->assertEquals(6,$result[2]);
    }
    
    public function testSimpleSetIndex()
    {
        $test = new TestSimpleArrayLeaf();
        $test->setValue(9,['1']);
        $this->assertEquals(9,$test->getValue(['1']));
    }
    
    public function testSimpleSetIndexWithOrder()
    {
        $test = new TestSimpleArrayLeaf();
        $test->setValue(9,['by_reverse','0']);
        $this->assertEquals(9,$test->getValue(['2']));
    }
    
    public function testSimpleSetIndexWithFilter()
    {
        $test = new TestSimpleArrayLeaf();
        $test->setValue(9,['where_great','0']);
        $this->assertEquals(9,$test->getValue(['1']));
    }
    
    public function testComplexGetCount()
    {
        $test = new TestComplexArrayLeaf();
        $this->assertEquals(3,$test->getValue(['1','count']));
    }
    
    public function testComplexGetIndex()
    {
        $test = new TestComplexArrayLeaf();
        $this->assertEquals(6,$test->getValue(['0','2']));        
        $this->assertEquals(8,$test->getValue(['1','1']));
        $this->assertEquals(6,$test->getValue(['2','0']));
    }

    public function testComplexSetIndex()
    {
        $test = new TestComplexArrayLeaf();
        $test->setValue('A',['0','2']);
        $test->setValue('B',['1','1']);
        $test->setValue('C',['2','0']);
        $this->assertEquals('A',$test->getValue(['0','2']));
        $this->assertEquals('B',$test->getValue(['1','1']));
        $this->assertEquals('C',$test->getValue(['2','0']));
    }
    
    public function testGetElement_endthis1()
    {
        $test = new TestComplexArrayLeaf();
        $item = $test->getElement('count',[]);
        $this->assertEquals($test,$item);
    }
    
    public function testGetElement_endthis2()
    {
        $test = new TestComplexArrayLeaf();
        $item = $test->getElement('all',[]);
        $this->assertEquals($test,$item);
    }
    
    public function testGetElement_endnext()
    {
        $test = new TestComplexArrayLeaf();
        $item = $test->getElement('1',['2']);
        $this->assertTrue(is_a($item, TestSimpleArrayLeaf::class));
    }
    
    
}
