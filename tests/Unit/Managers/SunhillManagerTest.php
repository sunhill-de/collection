<?php

namespace Sunhill\Collection\Tests\Unit\Managers;

use Sunhill\Collection\Tests\DatabaseTestCase;
use Sunhill\Collection\Facades\SunhillManager;

class SunhillManagerTest extends DatabaseTestCase
{
    public function testSearchEventType()
    {
        $this->assertEquals('watch',SunhillManager::searchEventType('watch')->name);
        $this->assertNull(SunhillManager::searchEventType('notexisting'));
    }
    
    public function testSearchOrInsertEventType()
    {
        $this->assertEquals('watch',SunhillManager::searchOrInsertEventType('watch')->name);
        $this->assertEquals('listen',SunhillManager::searchOrInsertEventType('listen')->name);
        $this->assertDatabaseHas('eventtypes',['name'=>'listen']);
    }
    
    public function testSearchLanguage()
    {
        $this->assertEquals('english',SunhillManager::searchLanguage('english')->name);
        $this->assertNull(SunhillManager::searchLanguage('notexisting'));
    }
    
    public function testSearchOrInsertLanguage()
    {
        $this->assertEquals('english',SunhillManager::searchOrInsertLanguage('english')->name);
        $this->assertEquals('polish',SunhillManager::searchOrInsertLanguage('polish','pl')->name);
        $this->assertEquals('greek',SunhillManager::searchOrInsertLanguage('greek')->name);
        $this->assertDatabaseHas('languages',['name'=>'polish']);
        $this->assertDatabaseHas('languages',['name'=>'greek']);
    }
    
    public function testSearchStaffJob()
    {
        $this->assertEquals('actor',SunhillManager::searchStaffJob('actor')->name);
        $this->assertNull(SunhillManager::searchStaffJob('notexisting'));
    }

    public function testSearchOrInsertStaffJob()
    {
        $this->assertEquals('actor',SunhillManager::searchOrInsertStaffJob('actor')->name);
        $this->assertEquals('producer',SunhillManager::searchOrInsertStaffJob('producer')->name);
        $this->assertDatabaseHas('staffjobs',['name'=>'producer']);
    }
    
}