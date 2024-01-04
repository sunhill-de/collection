<?php

use Sunhill\InfoMarket\Marketeers\Network\MacPingItem;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\Collection\Tests\DatabaseTestCase;
use Sunhill\Collection\Marketeers\Network\PingItem;
use Sunhill\Collection\Tests\CollectionTestCase;

class PingItemTest extends CollectionTestCase
{

    public function testPingItemSuccess()
    {
        $item = new PingItem('test');
        
        $data = $item->getPingData(file_get_contents(dirname(__FILE__).'/../../../files/ping_success'));
        
        $this->assertEquals(1, $data->status);
        $this->assertEquals(64, $data->ttl);
        $this->assertEquals(3.39, $data->response);
        $this->assertEquals('192.168.1.1', $data->ip);
    }

    public function testPingItemHostUnreachable()
    {
        $item = new PingItem('test');
        
        $data = $item->getPingData(file_get_contents(dirname(__FILE__).'/../../../files/ping_hostfail'));
        
        $this->assertEquals(0, $data->status);
        $this->assertEquals("Destination Host Unreachable", $data->message);
        $this->assertEquals('192.168.1.2', $data->ip);
    }
    
    public function testPingItemNetUnreachable()
    {
        $item = new PingItem('test');
        
        $data = $item->getPingData(file_get_contents(dirname(__FILE__).'/../../../files/ping_netfail'));
        
        $this->assertEquals(0, $data->status);
        $this->assertEquals("Destination Net Unreachable", $data->message);
        $this->assertEquals('6.6.6.6', $data->ip);
    }
    
}