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
    
    protected function getThisCount(array $remains): int
    {
        return 3;
    }
    
    protected function getThisElement(int $index, array $remains)
    {
        return $this->values[$index];    
    }
    
    protected function setThisElement(int $index, $value, array $remains)
    {
        $this->values[$index] = $value;
    }
    
}


class ArrayLeafTest extends SunhillNoAppTestCase
{
    
    public function testGetCount()
    {
        $test = new FakeArrayLeaf();
        $response = new Response();
        $response->setElement('method','get');
        $this->assertTrue($test->route(['array','count'],'anybody',$response));
        $this->assertEquals(3,$response->get('object')->value);        
    }
    
    public function testGetIndex()
    {
        $test = new FakeArrayLeaf();
        $response = new Response();
        $response->setElement('method','get');
        $this->assertTrue($test->route(['array','2'],'anybody',$response));
        $this->assertEquals(6,$response->get('object')->value);        
    }
    
    public function testSetIndex()
    {
        
    }
}