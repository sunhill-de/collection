<?php

namespace Sunhill\InfoMarket\Tests\Feature;

class InfoMarketWriteTest extends InfoMarketBase
{

    public function testWriteItem()
    {
        $test = $this->getMarket();
        $test->setItem('test.item',7,'anybody');        
        $this->assertEquals(7,$test->getItem('test.item','anybody','object')->value);
    }
    
    public function testWriteIndexed()
    {
        $test = $this->getMarket();
        $test->setItem('indexed.1.test',7,'anybody');
        $this->assertEquals(14,$test->getItem('indexed.2.test','anybody','object')->value);        
    }
    
    public function testWriteItemList()
    {
        $test = $this->getMarket();
        $result = $test->setItemList(['indexed.1.test','test.item'],7,'anybody');
        $result = $test->getItemList(['indexed.1.test','test.item'],'anybody','object');
        $this->assertEquals(7,$result['indexed.1.test']->value);
        $this->assertEquals(7,$result['test.item']->value);        
    }
}
