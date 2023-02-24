<?php

use Sunhill\InfoMarket\Marketeers\Network\MacPingItem;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Tests\InfoMarketTest;

class MacPingTest extends InfoMarketTest
{

    public function testDeviceCount()
    {
        $test = new MacPingItem();
        $this->assertEquals(29,$this->callProtectedMethod($test, 'getCount'));
    }
}