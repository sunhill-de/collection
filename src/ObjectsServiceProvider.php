<?php

namespace Sunhill\Collection;

use Illuminate\Support\ServiceProvider;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\Dialogs;

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
use Sunhill\Collection\Objects\Mime;
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
        Dialogs::addObjectKeyfield(Anniversary::class,':name');

        Dialogs::addObjectListFields(Country::class,['name','iso_code']);
        Dialogs::addObjectKeyfield(Country::class,':name');

        Dialogs::addObjectListFields(CreativeWork::class,['name']);
        Dialogs::addObjectKeyfield(CreativeWork::class,':name');
        
        Dialogs::addObjectListFields(Date::class,['begin_date','name']);
        Dialogs::addObjectKeyfield(Date::class,':name');

        Dialogs::addObjectListFields(Event::class,['start_stamp','work'=>'work=>name']);
        Dialogs::addObjectKeyfield(Event::class,':start_stamp');

        Dialogs::addObjectListFields(Genre::class,['name','parent'=>'parent=>name']);
        Dialogs::addObjectKeyfield(Genre::class,':name');

        Dialogs::addObjectListFields(Location::class,['name','part_of'=>'part_of=>name']);
        Dialogs::addObjectKeyfield(Location::class,':name');

        Dialogs::addObjectListFields(Mime::class,['mimegroup','item']);
        Dialogs::addObjectKeyfield(Mime::class,':mimegroup / :item');        

        Dialogs::addObjectListFields(MusicalArtist::class,['name','sort_name']);
        Dialogs::addObjectKeyfield(MusicalArtist::class,':name');        
        
        Dialogs::addObjectListFields(Network::class,['name','prefix','description','part_of'=>'part_of=>name']);
        Dialogs::addObjectKeyfield(Network::class,':name');

        Dialogs::addObjectListFields(Organisation::class,['name']);
        Dialogs::addObjectKeyfield(Organisation::class,':name');

        Dialogs::addObjectListFields(Person::class,['firstname','lastname']);
        Dialogs::addObjectKeyfield(Person::class,':firstname :lastname');
        
        Dialogs::addObjectListFields(ProductGroup::class,['name','part_of'=>'part_of=>name']);
        Dialogs::addObjectKeyfield(ProductGroup::class,':name');

        Dialogs::addObjectListFields(Property::class,['name','type']);
        Dialogs::addObjectKeyfield(Property::class,':name');

        Dialogs::addObjectListFields(Transaction::class,['order_id','shop'=>'shop=>name']);
        
    }
    
    public function boot()
    {
        $this->loadJSONTranslationsFrom(__DIR__.'/../resources/lang');
        $this->registerClasses();
        $this->defineDialogs();
    }
}
