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
use Sunhill\Collection\Collections\PersonsRelation;
use Sunhill\Collection\Objects\Persons\Person;
use Sunhill\Collection\Collections\Staff;
use Sunhill\Collection\Collections\ProductGroup;
use Sunhill\Collection\Collections\StaffJob;
use Sunhill\Collection\Objects\Persons\Friend;
use Sunhill\Collection\Objects\Persons\FamilyMember;
use Sunhill\Collection\Objects\Locations\Country;
use Sunhill\Collection\Objects\Locations\Address;
use Sunhill\Collection\Objects\Locations\City;
use Sunhill\Collection\Objects\Locations\Street;
use Sunhill\Collection\Objects\Locations\Floor;
use Sunhill\Collection\Objects\Locations\Room;
use Sunhill\Collection\Collections\MusicalArtist;
use Sunhill\Collection\Objects\Creative\Clip;
use Sunhill\Collection\Objects\Creative\Episode;
use Sunhill\Collection\Objects\Creative\MovieSeries;
use Sunhill\Collection\Objects\Creative\TVSeries;
use Sunhill\Collection\Objects\Creative\Movie;

class SunhillManagerTest extends DatabaseTestCase
{
// ************************ Search and insert helpers ************************    
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

// ************************** List and dialogs helpers *************************
    
    /**
     * @dataProvider GetKeyfieldProvider
     * @group keyfield
     * @group listutils
     */
    public function testGetKeyfield($collection, $id, $expect)
    {
        $object = new $collection();
        if (is_numeric($id)) {
            $object->load($id);
        } else {
            $object->load($object::getSeedID($id));            
        }
        
        $this->assertEquals($expect, SunhillManager::getKeyfield($object));
    }

    public static function getKeyfieldProvider()
    {
        return [
            // Test collections
            [Anniversary::class, 1, "Homer's birthday"],
            [Event::class, 1, "2023-09-13 11:39:00"],
            [EventType::class, 1, 'watch'],
            [Genre::class, 1, 'fiction'],
            [Language::class, 1, 'english'],
            [MusicalArtist::class, 1, 'Muse'],
            [Network::class, 1, 'home'],
            [PersonsRelation::class, 1, 'marriage Homer Simpson & Marge Simpson'],
            [ProductGroup::class, 1, 'food'],
            [Staff::class, 1, 'Edward Norton (Narrator)'],
            [Staff::class, 4, 'David Fincher '],
            [StaffJob::class, 1, 'actor'],
            
            // Test person related objects
            [Person::class, 'norton', 'Edward Norton'],
            [Friend::class, 'carl', 'Carl Carlson'],
            [FamilyMember::class, 'homer', 'Homer Simpson'],            

            // Test location related objects
            [Country::class, 'usa', 'U.S.A.'],
            [City::class, 'springfield', 'Springfield'],
            [Street::class, 'evergreen', 'Evergreen Terrace'],
            [Address::class, 'simpsons', '742 Evergreen Terrace'],
            [Floor::class, 'ground', 'Ground floor'],
            [Room::class, 'living', 'Living room'],
            
            // Test creative related objects
            [Clip::class, 'bartsfirststeps', "Bart's first steps"],
            [Episode::class, 'constant', 'Die Konstante (S4 E5)'],
            [Movie::class, 'fightclub', 'Fight Club'],
            [MovieSeries::class, 'alien','Alien'],
            [TVSeries::class, 'sons', 'Sons of Anarchy'],
            
        ];    
    }
    
    /**
     * @dataProvider GetCollectionListProvider
     * @group list
     * @group listutils
     */
    public function testGetCollectionList($collection, $conditions, $order, $order_dir, $offset, $limit, $expect)
    {
        $this->assertTrue($this->checkArrays($expect, SunhillManager::getCollectionList($collection, $conditions, $order, $order_dir, $offset, $limit)));                
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
            ['Language', [], 'id', 'asc', 0, 3, [
                ['name'=>'english','iso'=>'en'],
                ['name'=>'german','iso'=>'de'],
                ['name'=>'french','iso'=>'fr'],
            ]],
            ['MusicalArtist', [], 'id', 'asc', 0, 3, [
                ['name'=>'Muse','type'=>'group'],
                ['name'=>'Iron Maiden','type'=>'group'],
                ['name'=>'french','type'=>'group'],
            ]],
            ['Network', [], 'id', 'asc', 0, 3, [
                ['name'=>'home','prefix'=>'192.168','part_of'=>''],
                ['name'=>'dmz','prefix'=>'192.168.1','part_of'=>'home'],
                ['name'=>'int','prefix'=>'192.168.2','part_of'=>'home'],
            ]],
            ['PersonsRelation', [], 'id', 'asc', 0, 3, [
                ['person1'=>'Homer Simpson','person2'=>'Marge Simpson','relation'=>'marriage'],
            ]],
            ['ProductGroup', [], 'id', 'asc', 0, 3, [
                ['name'=>'food','part_of'=>''],
                ['name'=>'nonfood','part_of'=>''],
                ['name'=>'electronics','part_of'=>'nonfood'],
            ]],
            ['Staff', [], 'id', 'asc', 0, 3, [
                ['person'=>'Edward Norton','job'=>'actor','additional'=>'Narrator'],
                ['person'=>'Brad Pitt','job'=>'actor','additional'=>'Tyler Durden'],
                ['person'=>'Helena Bonham Carter','job'=>'actor','additional'=>'Marla Singer'],
            ]],
            ['StaffJob', [], 'id', 'asc', 0, 3, [
                ['name'=>'actor'],
                ['name'=>'director'],
                ['name'=>'guitar'],
            ]],
        ];
    }
    
    /**
     * @group parameters
     */
    public function testGetCollectionListParameters()
    {
        $list = SunhillManager::getCollectionListParameters('EventType', [], 'id', 'asc', 0, 10);
        $this->assertEquals(3, $list['total_count']);
        $this->assertEquals('EventType', $list['name']);
        $this->assertEquals('Stores information about an event type', $list['description']);
        $this->assertFalse($list['groupeditable']);
        $this->assertTrue($list['instantiable']);
    }
    
    /**
     * @dataProvider GetObjectListProvider
     * @group objectlist
     * @group listutils
     */
    public function testGetObjectList($collection, $expect)
    {
        $this->assertTrue($this->checkArrays($expect, SunhillManager::getObjectList($collection)));
    }

    public static function GetObjectListProvider()
    {
        return [
            ['Location', [['name'=>'germany'],['name'=>'france'],['name'=>'spain']]],
            ['Country', [['name'=>'germany','capital'=>''],['name'=>'france','capital'=>''],['name'=>'spain','capital'=>'']]],
            ['City', [['name'=>'Springfield','part_of'=>'U.S.A'],['name'=>'Berlin','part_of'=>'Germany'],['name'=>'Madrid','part_of'=>'Spain']]],
            ['Street', [['name'=>'Evergreen Terrace','part_of'=>'Springfield'],['name'=>'Kufürstendamm','part_of'=>'Berlin']]],
            ['Address',['name'=>'742 Evergreen Terrace','part_of'=>'Evergreen Terrace']],
            ['Floor',['name'=>'Cellar','part_of'=>'742 Evergreen Terrace']],
            ['Room',['name'=>'Kitchen','part_of'=>'Ground floor']],
            
            ['CreativeWork',[['name'=>'Bla','original_name'=>'Blub']]],
        ];
    }
}