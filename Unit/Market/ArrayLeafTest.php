<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\ArrayLeaf;
use Sunhill\InfoMarket\Response\Response;

class FakeArrayLeaf extends ArrayLeaf
{
    public $values = [2,4,6];
        
    protected function getItemCount(Response $response, array $remains = []): int
    {
        return 3;    
    }
    
    protected function isItemWriteable($response, $remains)
    {
        return true;
    }
    
    protected function doGetIndexedItemValue(int $index, Response &$response, array $remains = [])
    {
        return $this->values[$index];
    }
    
    protected function doSetIndexedItemValue(int $index, $value, Response &$response, array $remains = [])
    {
        $this->values[$index] = $value;
        return true;
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
}