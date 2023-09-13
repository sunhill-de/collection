<?php

namespace Sunhill\Collection\Tests\Unit\Managers;

use Sunhill\Collection\Tests\DatabaseTestCase;
use Sunhill\Collection\Facades\SunhillManager;
use Sunhill\Collection\Collections\EventType;
use Sunhill\Collection\Collections\Anniversary;
use Sunhill\Collection\Collections\Genre;
use Sunhill\Collection\Collections\Event;
use Sunhill\Collection\Collections\Language;
use Sunhill\Collection\Collections\Network;

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
     * @group listutils
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
            [Event::class, 1, "2023-09-13 11:39:00"],
            [EventType::class, 1, 'watch'],
            [Genre::class, 1, 'fiction'],
            [Language::class, 1, 'english'],
            [Network::class, 1, 'home']
        ];    
    }
    
    /**
     * @dataProvider GetCollectionListProvider
     * @group list
     * @group listutils
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
            ['EventType', [['key'=>'name','relation'=>'=','value'=>'change']], 'name', 'asc', 0, 10, [['name'=>'change']]],
            
            ['Anniversary', [], 'id', 'asc', 0, 3, [
                ['name'=>"Homer's birthday", 'type'=>'birthday'],
                ['name'=>"Bart's birthday", 'type'=>'birthday'],
                ['name'=>"Lisa's birthday", 'type'=>'birthday'],                
            ]],
            ['Event', [], 'id', 'asc', 0, 1, [
                [
                    'who'=>'Homer Simpson', 
                    'when'=>"2023-09-13 11:39:00",
                    'what'=>'watch',
                    'to_whom'=>'Fight Club',
                ]
            ]],
            ['Genre', [], 'id', 'asc', 0, 3, [
                ['name'=>'fiction','parent'=>''],
                ['name'=>'nonfiction','parent'=>''],
                ['name'=>'science fiction','parent'=>'fiction'],
            ]],
            ['Network', [], 'id', 'asc', 0, 3, [
                ['name'=>'home','prefix'=>'192.168','part_of'=>''],
                ['name'=>'dmz','prefix'=>'192.168.1','part_of'=>'home'],
                ['name'=>'int','prefix'=>'192.168.2','part_of'=>'home'],
            ]],
        ];
    }
}