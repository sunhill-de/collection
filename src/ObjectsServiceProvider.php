<?php

namespace Sunhill\Objects;

use Illuminate\Support\ServiceProvider;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\Dialogs;

use Sunhill\Objects\Objects\Address;
use Sunhill\Objects\Objects\Anniversary;
use Sunhill\Objects\Objects\AnniversaryCelebration;
use Sunhill\Objects\Objects\Appointment;
use Sunhill\Objects\Objects\AudioMedium;
use Sunhill\Objects\Objects\Celebration;
use Sunhill\Objects\Objects\City;
use Sunhill\Objects\Objects\Computer;
use Sunhill\Objects\Objects\Country;
use Sunhill\Objects\Objects\CreativeWork;
use Sunhill\Objects\Objects\Date;
use Sunhill\Objects\Objects\ElectronicDevice;
use Sunhill\Objects\Objects\Event;
use Sunhill\Objects\Objects\FamilyMember;
use Sunhill\Objects\Objects\Floor;
use Sunhill\Objects\Objects\Friend;
use Sunhill\Objects\Objects\Genre;
use Sunhill\Objects\Objects\ListeningEvent;
use Sunhill\Objects\Objects\Location;
use Sunhill\Objects\Objects\Manufacturer;
use Sunhill\Objects\Objects\MediaDevice;
use Sunhill\Objects\Objects\Medium;
use Sunhill\Objects\Objects\Mime;
use Sunhill\Objects\Objects\MobileDevice;
use Sunhill\Objects\Objects\MusicalArtist;
use Sunhill\Objects\Objects\Network;
use Sunhill\Objects\Objects\NetworkDevice;
use Sunhill\Objects\Objects\Organisation;
use Sunhill\Objects\Objects\Person;
use Sunhill\Objects\Objects\PersonsRelation;
use Sunhill\Objects\Objects\ProductGroup;
use Sunhill\Objects\Objects\Property;
use Sunhill\Objects\Objects\ReadingEvent;
use Sunhill\Objects\Objects\Room;
use Sunhill\Objects\Objects\Server;
use Sunhill\Objects\Objects\Shop;
use Sunhill\Objects\Objects\Street;
use Sunhill\Objects\Objects\Transaction;
use Sunhill\Objects\Objects\Trip;
use Sunhill\Objects\Objects\VideoDevice;
use Sunhill\Objects\Objects\VisualMedium;
use Sunhill\Objects\Objects\VisualWork;
use Sunhill\Objects\Objects\WatchingEvent;
use Sunhill\Objects\Objects\WrittenMedium;
use Sunhill\Objects\Objects\WrittenWork;


class ObjectsServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
    
    protected function registerClasses() {
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
        Classes::registerClass(Mime::class);
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
    
    protected function defineDialogs()
    {
        Dialogs::addObjectListFields(Anniversary::class,['name','type']);
        Dialogs::addObjectListFields(Country::class,['name','iso_code']);
        Dialogs::addObjectListFields(CreativeWork::class,['name']);
        Dialogs::addObjectListFields(Event::class,['start_stamp','work'=>'work=>name']);
        Dialogs::addObjectListFields(Location::class,['name','part_of'=>'part_of=>name']);
        Dialogs::addObjectListFields(Mime::class,['mimegroup','item']);
        Dialogs::addObjectListFields(MusicalArtist::class,['name','sort_name']);
        Dialogs::addObjectListFields(Organisation::class,['name']);
        Dialogs::addObjectListFields(Person::class,['firstname','lastname']);
        Dialogs::addObjectListFields(ProductGroup::class,['name','part_of'=>'part_of=>name']);
        Dialogs::addObjectListFields(Transaction::class,['order_id','shop'=>'shop=>name']);
        
        Dialogs::addObjectKeyfield(Event::class,':start_stamp');
        Dialogs::addObjectKeyfield(Country::class,':name');
        Dialogs::addObjectKeyfield(CreativeWork::class,':name');
        Dialogs::addObjectKeyfield(Location::class,':name');
        Dialogs::addObjectKeyfield(Mime::class,':mimegroup / :item');        
        Dialogs::addObjectKeyfield(MusicalArtist::class,':name');
        Dialogs::addObjectKeyfield(Organisation::class,':name');
        Dialogs::addObjectKeyfield(Person::class,':firstname :lastname');
        Dialogs::addObjectKeyfield(Property::class,':name');
        Dialogs::addObjectKeyfield(Genre::class,':name');
        Dialogs::addObjectKeyfield(Network::class,':name');
        Dialogs::addObjectKeyfield(Date::class,':name');
    }
    
    public function boot()
    {
        $this->loadJSONTranslationsFrom(__DIR__.'/../resources/lang');
        $this->registerClasses();
        $this->defineDialogs();
    }
}
