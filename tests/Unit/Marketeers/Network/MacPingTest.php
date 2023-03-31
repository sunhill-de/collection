<?php

use Sunhill\InfoMarket\Marketeers\Network\MacPingItem;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\Collection\Tests\TestCase;

class MacPingTest extends TestCase
{

    public function testDeviceCount()
    {
        $test = new MacPingItem();
        $this->assertEquals(29,$this->callProtectedMethod($test, 'getCount'));
    }
}