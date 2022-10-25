<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Market\Leaf;
use Sunhill\InfoMarket\Response\Response;

class FakeLeaf extends Leaf
{
    protected function doRoute(string $element, array $remains, string $credentials, Response &$response)
    {
        return false;
    }
    
    /**
     * This is the expected end point for items.
     * {@inheritDoc}
     * @see \Sunhill\InfoMarket\Market\Leaf::routeFinished()
     */
    protected function routeFinished(string $credentials, Response &$response)
    {
        return false;
    }
    
}

class LeafTest extends SunhillNoAppTestCase
{
    
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