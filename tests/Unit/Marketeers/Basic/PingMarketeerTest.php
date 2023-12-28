<?php

namespace Sunhill\Collection\Tests\Unit\Marketeers\Basic;

use Sunhill\Collection\Facades\SunhillCache;
use Sunhill\Collection\Tests\CollectionTestCase;
use Sunhill\Collection\Marketeers\Basic\PingMarketeer;

class PingMarketeerTest extends CollectionTestCase
{

    public function testPingSuccess()
    {
        SunhillCache::shouldReceive('getEntry')->once()->andReturn(file_get_contents(dirname(__FILE__).'/../../../files/ping_success'));
        
        $ping_item = new PingMarketeer();
        
        $this->assertEquals(1, $ping_item->getProperty('status')->getValue());
        $this->assertEquals(64, $ping_item->getProperty('ttl')->getValue());
        $this->assertEquals(3.39, $ping_item->getProperty('time')->getValue());
        
    }
    
    public function testPingHostFail()
    {
        SunhillCache::shouldReceive('getEntry')->once()->andReturn(file_get_contents(dirname(__FILE__).'/../../../files/ping_hostfail'));
        
        $ping_item = new PingMarketeer();
        
        $this->assertEquals(0, $ping_item->getProperty('status')->getValue());
        $this->assertEquals('Destination Host Unreachable', $ping_item->getProperty('error')->getValue());
    }
    
    public function testPingNetworkFail()
    {
        SunhillCache::shouldReceive('getEntry')->once()->andReturn(file_get_contents(dirname(__FILE__).'/../../../files/ping_netfail'));
        
        $ping_item = new PingMarketeer();
        
        $this->assertEquals(0, $ping_item->getProperty('status')->getValue());
        $this->assertEquals('Destination Net Unreachable', $ping_item->getProperty('error')->getValue());
    }
    
}