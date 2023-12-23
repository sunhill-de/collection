<?php

namespace Sunhill\Collection\Tests\Unit\Managers;

use Sunhill\Collection\Facades\Cache;
use Sunhill\Collection\Tests\DatabaseTestCase;

class CacheManagerTest extends DatabaseTestCase
{

    public function testGetCacheGroups()
    {
        $this->assertEquals(3, Cache::getCacheGroupsCount());
        $this->assertEquals('groupA', Cache::getCacheGroup(0)['name']);        
    }
    
    public function testAddCacheGroup()
    {
        $this->assertEquals(4, Cache::addCacheGroup(['name'=>'groupD']));
        $this->assertEquals('groupD', Cache::getCacheGroup(3)['name']);
    }
    
    public function testEditCacheGroup()
    {
        Cache::editCacheGroup(3, ['name'=>'newGroup']);
        $this->assertEquals('newGroup', Cache::getCacheGroup(2)['name']);
    }
    
    public function testDeleteCacheGroup()
    {
        Cache::deleteCacheGroup(3);
        $this->assertEquals(2, Cache::getCacheGroupsCount());
    }

}