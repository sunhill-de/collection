<?php

use Sunhill\InfoMarket\Marketeers\Network\MacPingItem;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\Collection\Tests\DatabaseTestCase;

class MacPingTest extends DatabaseTestCase
{

    public function testDeviceCount()
    {
        $test = new MacPingItem();
        $this->assertEquals(29,$this->callProtectedMethod($test, 'getCount'));
    }
}