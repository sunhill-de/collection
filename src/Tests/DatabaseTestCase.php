<?php

namespace Sunhill\Collection\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Sunhill\Collection\Objects\Address;
use Sunhill\Collection\Objects\Anniversary;
use Sunhill\Collection\Objects\AnniversaryCelebration;
use Sunhill\Collection\Objects\Appointment;
use Sunhill\Collection\Objects\AudioMedium;
use Sunhill\Collection\Objects\Celebration;
use Sunhill\Collection\Objects\City;
use Sunhill\Collection\Objects\Computer;
use Sunhill\Collection\Objects\Country;
use Sunhill\Collection\Objects\CreativeWork;
use Sunhill\Collection\Objects\Date;
use Sunhill\Collection\Objects\ElectronicDevice;
use Sunhill\Collection\Objects\Event;
use Sunhill\Collection\Objects\FamilyMember;
use Sunhill\Collection\Objects\Floor;
use Sunhill\Collection\Objects\Friend;
use Sunhill\Collection\Objects\Genre;
use Sunhill\Collection\Objects\ListeningEvent;
use Sunhill\Collection\Objects\Location;
use Sunhill\Collection\Objects\Manufacturer;
use Sunhill\Collection\Objects\MediaDevice;
use Sunhill\Collection\Objects\Medium;
use Sunhill\Collection\Objects\MobileDevice;
use Sunhill\Collection\Objects\MusicalArtist;
use Sunhill\Collection\Objects\Network;
use Sunhill\Collection\Objects\NetworkDevice;
use Sunhill\Collection\Objects\Organisation;
use Sunhill\Collection\Objects\Person;
use Sunhill\Collection\Objects\PersonsRelation;
use Sunhill\Collection\Objects\ProductGroup;
use Sunhill\Collection\Objects\Property;
use Sunhill\Collection\Objects\ReadingEvent;
use Sunhill\Collection\Objects\Room;
use Sunhill\Collection\Objects\Server;
use Sunhill\Collection\Objects\Shop;
use Sunhill\Collection\Objects\Street;
use Sunhill\Collection\Objects\Transaction;
use Sunhill\Collection\Objects\Trip;
use Sunhill\Collection\Objects\VideoDevice;
use Sunhill\Collection\Objects\VisualMedium;
use Sunhill\Collection\Objects\VisualWork;
use Sunhill\Collection\Objects\WatchingEvent;
use Sunhill\Collection\Objects\WrittenMedium;
use Sunhill\Collection\Objects\WrittenWork;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Objects;


class DatabaseTestCase extends TestCase
{
    
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->registerClasses();
        $this->migrateSunhill();
        $this->seed(DatabaseSeeder::class);
    }
    
    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../../tests/Database/migrations');
    }
    
    protected function migrateSunhill()
    {
    }
    
    protected function registerClasses()
    {
        Objects::flushCache();
        Classes::flushClasses();
        Classes::registerClass(Address::class);
        Classes::registerClass(Anniversary::class);
        Classes::registerClass(AnniversaryCelebration::class);
        Classes::registerClass(Appointment::class);
        Classes::registerClass(AudioMedium::class);
        Classes::registerClass(Celebration::class);
        Classes::registerClass(City::class);
        Classes::registerClass(Computer::class);
        Classes::registerClass(Country::class);
        Classes::registerClass(CreativeWork::class);
        Classes::registerClass(Date::class);
        Classes::registerClass(ElectronicDevice::class);
        Classes::registerClass(Event::class);
        Classes::registerClass(FamilyMember::class);
        Classes::registerClass(Floor::class);
        Classes::registerClass(Friend::class);
        Classes::registerClass(Genre::class);
        Classes::registerClass(ListeningEvent::class);
        Classes::registerClass(Location::class);
        Classes::registerClass(Manufacturer::class);
        Classes::registerClass(MediaDevice::class);
        Classes::registerClass(Medium::class);
        Classes::registerClass(MobileDevice::class);
        Classes::registerClass(MusicalArtist::class);
        Classes::registerClass(Network::class);
        Classes::registerClass(NetworkDevice::class);
        Classes::registerClass(Organisation::class);
        Classes::registerClass(Person::class);
        Classes::registerClass(PersonsRelation::class);
        Classes::registerClass(ProductGroup::class);
        Classes::registerClass(Property::class);
        Classes::registerClass(ReadingEvent::class);
        Classes::registerClass(Room::class);
        Classes::registerClass(Server::class);
        Classes::registerClass(Shop::class);
        Classes::registerClass(Street::class);
        Classes::registerClass(Transaction::class);
        Classes::registerClass(Trip::class);
        Classes::registerClass(VideoDevice::class);
        Classes::registerClass(VisualMedium::class);
        Classes::registerClass(VisualWork::class);
        Classes::registerClass(WatchingEvent::class);
        Classes::registerClass(WrittenMedium::class);
        Classes::registerClass(WrittenWork::class);
    }
    
}