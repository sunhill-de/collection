<?php

namespace Sunhill\InfoMarket\Tests\Feature\Market;

class InfoMarketWriteTest extends InfoMarketBase
{

    public function testWriteItem()
    {
        $test = $this->getMarket();
        $test->setItem('test.item','anybody',7);        
        $this->assertEquals(7,$test->getItem('test.item','anybody','object')->value);
    }
}
