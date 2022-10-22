<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Market\Leaf;
use Sunhill\InfoMarket\Response\Response;

class FakeLeaf extends Leaf
{
    public $value = 4;
    
    public function switchAllowOn()
    {
        $this->remains_allowed = true;    
    }
    
    protected function isWriteable($response, $remains)
    {
        return true;
    }
    
    protected function doGetItemValue(Response &$response, array $remains = [])
    {
        return $this->value;
    }
    
    protected function doSetItemValue($value, Response &$response, array $remains = [])
    {
        $this->value = $value;
        return true;
    }
    
}

class LeafTest extends SunhillNoAppTestCase
{
    
    public function testGetItem()
    {
        $test = new FakeLeaf();
        $response = new Response();
        $response->setElement('method','get'); 
        $this->assertEquals(4,$test->route([],'anybody',$response));
    }
    
    public function testSetItem()
    {
        $test = new FakeLeaf();
        $response = new Response();
        $response->setElement('value',5);
        $response->setElement('method','set');
        $test->route([],'anybody',$response);
        
        $this->assertEquals(5,$test->value);        
    }
    
    public function testRemainForbidden()
    {
        $test = new FakeLeaf();
        $response = new Response();
        $response->setElement('method','get');
        $this->assertFalse($test->route(['a'],'anybody',$response));        
    }
    
    public function testRemainAllowed()
    {
        $test = new FakeLeaf();
        $test->switchAllowOn();
        $response = new Response();
        $response->setElement('method','get');
        $this->assertTrue($test->route(['a'],'anybody',$response));        
    }

    /**
     * @dataProvider checkRestrictionProvider
     * @param unknown $restriction
     * @param unknown $user
     * @param unknown $expect
     */
    public function testCheckRestriction($restriction, $user, $expect)
    {
        $test = new FakeLeaf();
        $this->assertEquals($expect, $this->callProtectedMethod($test,'checkRestriction',[$restriction,$user]));
    }
    
    public function checkRestrictionProvider()
    {
        return [
            ['anybody','anybody',true],
            ['anybody','user',true],
            ['anybody','advanced',true],
            ['anybody','admin',true],
            
            ['user','anybody',false],
            ['user','user',true],
            ['user','advanced',true],
            ['user','admin',true],
            
            ['advanced','anybody',false],
            ['advanced','user',false],
            ['advanced','advanced',true],
            ['advanced','admin',true],
            
            ['admin','anybody',false],
            ['admin','user',false],
            ['admin','advanced',false],
            ['admin','admin',true]
        ];
    }
}