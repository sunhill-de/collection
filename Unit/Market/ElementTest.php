<?php

use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;

class FakeElement extends Element
{
    public $value = 5;
    
    protected function getThisElement(string $next, array $remains)
    {
        return $this;
    }
    
    protected function getThisMetadata(Response &$response, array $remains = [] )
    {
        $response->unit(' ')->semantic('name')->setElement('readable',true);        
    }
    
    protected function getThisValue(array $remains = [])
    {
        return $this->value;    
    }
    
    protected function setThisValue($value, array $remains = [])
    {
        $this->value = $value;        
    }
    
    protected function isThisAllowedToRead(string $credentials, array $remains = []): bool
    {
        return true;
    }
    
    protected function isThisAllowedToWrite(string $credentials, array $remains = []): bool
    {
        return false;
    }
    
    protected function getThisOffer()
    {
        return ['a.b.c'];
    }
    
}

class ElementTest extends InfoMarketTest
{
    
    public function testWrappers()
    {
        $test = new FakeElement();
        $response = new Response();
        $test->getMetadata($response,[]);
        $this->assertEquals(true,$test->isAllowedToRead('anybody',[]));
        $this->assertEquals(false,$test->isAllowedToWrite('anybody',[]));
        $this->assertEquals(5,$test->getValue([]));
        $test->setValue(6,[]);
        $this->assertEquals(6,$test->value);
    }
    
    /**
     * @dataProvider checkRestrictionProvider
     * @param unknown $restriction
     * @param unknown $user
     * @param unknown $expect
     */
    public function testCheckRestriction($restriction, $user, $expect)
    {
        $test = new FakeElement();
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
        
        $test = new FakeElement();
        $new = $this->callProtectedMethod($test, 'mergeMetadata', [$default, $overwrite]);
        
        $this->assertEquals(['a'=>1,'b'=>'B','c'=>3],$new);
    }
    
}