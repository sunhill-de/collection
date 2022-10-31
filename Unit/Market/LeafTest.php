<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Market\Leaf;
use Sunhill\InfoMarket\Response\Response;

class FakeLeaf extends Leaf
{

    protected function getThisMetadata(Response &$response, array $remains = [] )
    {
    }
    
    protected function getThisValue(array $remains = [])
    {
    }
    
    protected function setThisValue($value, array $remains = [])
    {
    }
    
    protected function isThisAllowedToRead(string $credentials, array $remains = []): bool
    {
    }
    
    protected function isThisAllowedToWrite(string $credentials, array $remains = []): bool
    {
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
    
    public function testMergeMetadata()
    {
        $default = ['a'=>1,'b'=>2,'c'=>3];
        $overwrite = ['b'=>'B'];
        
        $test = new FakeLeaf();
        $new = $this->callProtectedMethod($test, 'mergeMetadata', [$default, $overwrite]);
        
        $this->assertEquals(['a'=>1,'b'=>'B','c'=>3],$new);
    }
    
    public function testGetElement()
    {
        $test = new FakeLeaf();
        $result = $test->getElement('next',[]);
        $this->assertEquals($test,$result->element);
    }
    
    public function testGetOffer()
    {
        $test = new FakeLeaf();
        $test->setName('AA');
        $result = $test->getOffer();
        $this->assertEquals(['AA'],$result);
    }
    
}