<?php

namespace Sunhill\InfoMarket\Tests\Feature;

class InfoMarketReadTest extends InfoMarketBase
{
    
    public function testSimpleRead()
    {
        $test = $this->getMarket();
        $this->assertEquals(5,$test->getItem('test.item','anybody','object')->value);
    }
    
    public function testIndexRead()
    {
        $test = $this->getMarket();
        $this->assertEquals(10,$test->getItem('indexed.2.test','anybody','object')->value);        
    }
    
    public function testDoubleIndexRead()
    {
        $test = $this->getMarket();
        $this->assertEquals('ab+cd',$test->getItem('some.ab.test.cd','anybody','object')->value);
    }
   
    public function testReadListArray()
    {
        $test = $this->getMarket();
        $result = $test->getItemList(['test.item','test.another'],'anybody','object');
        $this->assertEquals(5,$result['test.item'].value);
        $this->assertEquals('Test',$result['test.another'].value);
    }

    public function testReadListJson()
    {
        $test = $this->getMarket();
        $result = $test->getItemList("{'test.item','test.another'}",'anybody','object');
        $this->assertEquals(5,$result['test.item'].value);
        $this->assertEquals('Test',$result['test.another'].value);
    }
    
    public function testReadListWildcard()
    {
        $test = $this->getMarket();
        $result = $test->getItemList("test.*",'anybody','object');
        $this->assertEquals(5,$result['test.item'].value);
        $this->assertEquals('Test',$result['test.another'].value);
    }
    
}
