<?php

namespace Sunhill\Collection\Tests\Unit\Managers;

use Sunhill\Collection\Tests\DatabaseTestCase;
use Sunhill\Collection\Facades\SunhillManager;
use Sunhill\Collection\Collections\EventType;
use Sunhill\Collection\Collections\Anniversary;
use Sunhill\Collection\Collections\Genre;

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
   
    /**
     * @dataProvider GetKeyfieldProvider
     * @group keyfield
     */
    public function testGetKeyfield($collection, $id, $expect)
    {
        $object = new $collection();
        $object->load($id);
        
        $this->assertEquals($expect, SunhillManager::getKeyfield($object));
    }
    
    public static function getKeyfieldProvider()
    {
        return [
            [Anniversary::class, 1, "Homer's birthday"],
            [EventType::class, 1, 'watch'],
            [Genre::class, 1, 'fiction']
        ];    
    }
    
    /**
     * @dataProvider GetCollectionListProvider
     * @group list
     */
    public function testGetCollectionList($collection, $conditions, $order, $order_dir, $offset, $limit, $expect)
    {
        $this->assertEquals($expect, SunhillManager::getCollectionList($collection, $conditions, $order, $order_dir, $offset, $limit));                
    }
    
    public static function GetCollectionListProvider()
    {
        return [
            ['EventType', [], 'id', 'asc', 0, 10, [['name'=>'watch'], ['name'=>'change'], ['name'=>'switch']]],
            ['EventType', [], 'id', 'desc', 0, 10, [['name'=>'switch'], ['name'=>'change'], ['name'=>'watch']]],
            ['EventType', [], 'id', 'desc', 1, 1, [['name'=>'change']]],
            ['EventType', [], 'name', 'asc', 0, 10, [['name'=>'change'], ['name'=>'switch'], ['name'=>'watch']]],
            
            ['Anniversary', [], 'id', 'asc', 0, 3, [
                ['name'=>"Homer's birthday", 'type'=>'birthday'],
                ['name'=>"Bart's birthday", 'type'=>'birthday'],
                ['name'=>"Lisa's birthday", 'type'=>'birthday'],                
            ]],
            ['Genre', [], 'id', 'asc', 0, 3, [
                ['name'=>'fiction','parent'=>''],
                ['name'=>'nonfiction','parent'=>''],
                ['name'=>'science fiction','parent'=>'fiction'],
            ]],
        ];
    }
}