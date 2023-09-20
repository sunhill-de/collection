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
use Sunhill\Collection\Objects\Creative\VisualCollection;
use Sunhill\Collection\Objects\Creative\VisualStandaloneWork;
use Sunhill\Collection\Objects\Creative\CreativeWork;
use Sunhill\Collection\Objects\Organisations\Manufacturer;
use Sunhill\Collection\Objects\Organisations\Shop;
use Sunhill\Collection\Objects\Organisations\Organisation;
use Sunhill\Collection\Objects\Locations\Location;

class SunhillManager_objects_Test extends DatabaseTestCase
{
    /**
     * @dataProvider GetObjectListProvider
     * @group objectlist
     * @group listutils
     */
    public function testGetObjectList($collection, $expect)
    {
        $list = SunhillManager::getObjectList($collection);
        $this->assertTrue($this->checkArrays($expect, $list));
    }

    public static function GetObjectListProvider()
    {
        return [
            ['Clip',[['name'=>"Bart's first steps",'type'=>'private']]],
            ['CreativeCollection',[['name'=>'Alien']]],
            ['CreativeStandaloneWork',[['name'=>'Fight Club']]],
            ['CreativeWork',[['name'=>'Fight Club']]],
            ['Episode',[['name'=>'Die Konstante','series'=>'Lost','season'=>4,'episode'=>5]]],
            ['Movie',[['name'=>'Fight Club','original_name'=>'Fight Club','release_date'=>'1999-11-11']]],           
            ['MovieSeries',[['name'=>'Alien']]],
            ['TVSeries',[['name'=>'Lost']]],
            ['VisualCollection',[['name'=>'Alien']]],
            ['VisualStandaloneWork',[['name'=>'Fight Club']]],
            
            ['Location', [['class'=>'Country','name'=>'germany'],['name'=>'france'],['name'=>'spain']]],
            ['Country', [['name'=>'germany','capital'=>''],['name'=>'france','capital'=>''],['name'=>'spain','capital'=>'']]],
            ['City', [['name'=>'Springfield','part_of'=>'U.S.A'],['name'=>'Berlin','part_of'=>'Germany'],['name'=>'Madrid','part_of'=>'Spain']]],
            ['Street', [['name'=>'Evergreen Terrace','part_of'=>'Springfield'],['name'=>'Kufürstendamm','part_of'=>'Berlin']]],
            ['Address',[['name'=>'742 Evergreen Terrace','part_of'=>'Evergreen Terrace']]],
            ['Floor',[['name'=>'Cellar','part_of'=>'742 Evergreen Terrace']]],
            ['Room',[['name'=>'Kitchen','part_of'=>'Ground floor']]],
            
        ];
    }
    
}