<?php

namespace Sunhill\Collection\Tests\Unit\Managers;

use Sunhill\Collection\Tests\DatabaseTestCase;
use Sunhill\Collection\Facades\SunhillManager;

class SunhillManagerTest extends DatabaseTestCase
{

    public function testSearchStaffJob()
    {
        $this->assertEquals('actor',SunhillManager::searchStaffJob('actor')->name);
        $this->assertNull(SunhillManager::searchStaffJob('notexisting'));
    }

    public function testSearchOrInsertStaffJob()
    {
        $this->assertEquals('actor',SunhillManager::searchOrInsertStaffJob('actor')->name);
        $this->assertEquals('producer',SunhillManager::searchOrInsertStaffJob('producer')->name);
    }
}