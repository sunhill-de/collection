<?php
namespace Sunhill\Collection;

use Sunhill\Collection\Managers\ImportManager;
use Sunhill\Collection\Managers\TMDBManager;
use Illuminate\Support\ServiceProvider;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Objects;
use Sunhill\Collection\Components\Input;
use Sunhill\Collection\Components\Lookup;

use Sunhill\Collection\Objects\Creative\Clip;
use Sunhill\Collection\Objects\Creative\CreativeCollection;
use Sunhill\Collection\Objects\Creative\CreativeStandaloneWork;
use Sunhill\Collection\Objects\Creative\CreativeWork;
use Sunhill\Collection\Objects\Creative\Episode;
use Sunhill\Collection\Objects\Creative\Movie;
use Sunhill\Collection\Objects\Creative\MovieSeries;
use Sunhill\Collection\Objects\Creative\TVSeries;
use Sunhill\Collection\Objects\Creative\VisualCollection;
use Sunhill\Collection\Objects\Creative\VisualStandaloneWork;
use Sunhill\Collection\Objects\Creative\WrittenWork;

use Sunhill\Collection\Objects\Locations\Address;
use Sunhill\Collection\Objects\Locations\City;
use Sunhill\Collection\Objects\Locations\Country;
use Sunhill\Collection\Objects\Locations\Floor;
use Sunhill\Collection\Objects\Locations\Location;
use Sunhill\Collection\Objects\Locations\Room;
use Sunhill\Collection\Objects\Locations\Street;

use Sunhill\Collection\Objects\Dates\AnniversaryCelebration;
use Sunhill\Collection\Objects\Dates\Appointment;
use Sunhill\Collection\Objects\Dates\Celebration;
use Sunhill\Collection\Objects\Dates\Date;
use Sunhill\Collection\Objects\Dates\Trip;

use Sunhill\Collection\Objects\Properties\Computer;
use Sunhill\Collection\Objects\Properties\ElectronicDevice;
use Sunhill\Collection\Objects\Properties\MediaDevice;
use Sunhill\Collection\Objects\Properties\Medium;
use Sunhill\Collection\Objects\Properties\MobileDevice;
use Sunhill\Collection\Objects\Properties\NetworkDevice;
use Sunhill\Collection\Objects\Properties\Property;
use Sunhill\Collection\Objects\Properties\Server;
use Sunhill\Collection\Objects\Properties\VideoDevice;
use Sunhill\Collection\Objects\Properties\VisualMedium;
use Sunhill\Collection\Objects\Properties\WrittenMedium;

use Sunhill\Collection\Objects\Persons\Person;
use Sunhill\Collection\Objects\Persons\FamilyMember;
use Sunhill\Collection\Objects\Persons\Friend;

use Sunhill\Collection\Objects\Organisations\Manufacturer;
use Sunhill\Collection\Objects\Organisations\Shop;
use Sunhill\Collection\Objects\Organisations\Organisation;

use Sunhill\Collection\Collections\ProductGroup;

use Illuminate\Support\Facades\Blade;
use Sunhill\ORM\Facades\Collections;

use Sunhill\Collection\Collections\Anniversary;
use Sunhill\Collection\Collections\Event;
use Sunhill\Collection\Collections\EventType;
use Sunhill\Collection\Collections\Genre;
use Sunhill\Collection\Collections\Language;
use Sunhill\Collection\Collections\Network;
use Sunhill\Collection\Collections\PersonsRelation;
use Sunhill\Collection\Collections\Staff;
use Sunhill\Collection\Collections\Transaction;
use Sunhill\Collection\Collections\StaffJob;
use Sunhill\Collection\Facades\SunhillManager;
use Sunhill\Collection\Collections\MusicalArtist;
use Sunhill\Visual\Facades\SunhillSiteManager;
use Sunhill\Collection\Response\Ajax\AjaxTags;
use Sunhill\Collection\Response\Ajax\AjaxClasses;
use Sunhill\Collection\Response\Ajax\AjaxStrings;
use Sunhill\Collection\Response\Ajax\AjaxObjects;
use Sunhill\Collection\Response\Ajax\AjaxAttributes;
use Sunhill\Collection\Response\Ajax\AjaxCollections;
use Sunhill\Collection\Response\Ajax\AjaxInfomarket;
use Sunhill\Collection\Response\Ajax\AjaxInfomarketNodes;
use Sunhill\Collection\Response\Ajax\AjaxCollectionField;
use Sunhill\Collection\Response\Ajax\AjaxObjectField;
use Sunhill\Collection\Objects\Locations\PseudoLocation;
use Sunhill\Collection\Managers\CacheManager;
use Sunhill\Collection\Collections\Cache_Group;
use Sunhill\Collection\Collections\Cache_Item;
use Sunhill\Collection\Collections\Cache_Entry;
use Sunhill\Collection\Collections\Cache_ItemTemplate;
use Sunhill\Collection\Managers\SunhillCacheManager;


class CollectionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ImportManager::class, function () { return new ImportManager(); } );
        $this->app->alias(ImportManager::class,'importmanager');
        $this->app->singleton(SunhillCacheManager::class, function () { return new SunhillCacheManager(); } );
        $this->app->alias(SunhillCacheManager::class,'sunhillcachemanager');
        $this->app->singleton(TMDBManager::class, function () { return new TMDBManager(); } );
        $this->app->alias(TMDBManager::class,'tmdbmanager');
        $this->app->singleton(SunhillManager::class, function () { return new \Sunhill\Collection\Managers\SunhillManager(); } );
        $this->app->alias(SunhillManager::class,'sunhillmanager');
        $this->mergeConfigFrom(__DIR__.'/../config/collection.php', 'collection');
        $this->mergeConfigFrom(__DIR__.'/../config/infomarket.php', 'infomarket');
        require_once __DIR__.'/Helpers/display_variable.php';
    }
    
    protected function registerCollections()
    {
        Collections::registerCollection(Anniversary::class);
        Collections::registerCollection(Event::class);
        Collections::registerCollection(EventType::class);
        Collections::registerCollection(Genre::class);
        Collections::registerCollection(Language::class);
        Collections::registerCollection(Network::class);
        Collections::registerCollection(PersonsRelation::class);
        Collections::registerCollection(Staff::class);
        Collections::registerCollection(StaffJob::class);
        Collections::registerCollection(Transaction::class);        
        Collections::registerCollection(ProductGroup::class);
        Collections::registerCollection(MusicalArtist::class);
        Collections::registerCollection(Cache_Entry::class);
        Collections::registerCollection(Cache_Group::class);
        Collections::registerCollection(Cache_Item::class);
        Collections::registerCollection(Cache_ItemTemplate::class);
        
    }
    
    protected function registerClasses()
    {
        Objects::flushCache();
        Classes::flush();
// Creative
        Classes::registerClass(Clip::class);
        Classes::registerClass(CreativeCollection::class);
        Classes::registerClass(CreativeStandaloneWork::class);
        Classes::registerClass(CreativeWork::class);
        Classes::registerClass(Episode::class);
        Classes::registerClass(Movie::class);
        Classes::registerClass(MovieSeries::class);
        Classes::registerClass(TVSeries::class);
        Classes::registerClass(VisualCollection::class);
        Classes::registerClass(VisualStandaloneWork::class);
        Classes::registerClass(WrittenWork::class);
 
// Locations        
        Classes::registerClass(Address::class);
        Classes::registerClass(City::class);
        Classes::registerClass(Country::class);
        Classes::registerClass(Floor::class);
        Classes::registerClass(Location::class);
        Classes::registerClass(Room::class);
        Classes::registerClass(Street::class);
        Classes::registerClass(PseudoLocation::class);
        
// Persons
        Classes::registerClass(FamilyMember::class);
        Classes::registerClass(Friend::class);
        Classes::registerClass(Person::class);
        
// Dates
        Classes::registerClass(AnniversaryCelebration::class);
        Classes::registerClass(Appointment::class);
        Classes::registerClass(Celebration::class);
        Classes::registerClass(Date::class);
        Classes::registerClass(Trip::class);
        
// Properties
        Classes::registerClass(Computer::class);
        Classes::registerClass(ElectronicDevice::class);
        Classes::registerClass(MediaDevice::class);
        Classes::registerClass(Medium::class);
        Classes::registerClass(MobileDevice::class);
        Classes::registerClass(NetworkDevice::class);
        Classes::registerClass(VideoDevice::class);
        Classes::registerClass(VisualMedium::class);
        Classes::registerClass(WrittenMedium::class);
        Classes::registerClass(Property::class);
        Classes::registerClass(Server::class);
        
// Organisations
        Classes::registerClass(Manufacturer::class);
        Classes::registerClass(Organisation::class);
        Classes::registerClass(Shop::class);

        
    }
    
    
    protected function defineDialogs()
    {       
        SunhillSiteManager::addCSSResource(__DIR__.'/../resources/css');
        SunhillSiteManager::addJSResource(__DIR__.'/../resources/js');
    }
    
    protected function registerMarketeers()
    {
    }
    
    protected function registerAjax()
    {
        SunhillSiteManager::addAjaxModule('tags', AjaxTags::class);
        SunhillSiteManager::addAjaxModule('classes', AjaxClasses::class);
        SunhillSiteManager::addAjaxModule('attributes', AjaxAttributes::class);
        SunhillSiteManager::addAjaxModule('objects', AjaxObjects::class);
        SunhillSiteManager::addAjaxModule('collections', AjaxCollections::class);
        SunhillSiteManager::addAjaxModule('strings', AjaxStrings::class);
        SunhillSiteManager::addAjaxModule('infomarket', AjaxInfomarket::class);
        SunhillSiteManager::addAjaxModule('infomarketnodes', AjaxInfomarketNodes::class);
        SunhillSiteManager::addAjaxModule('collectionfield', AjaxCollectionField::class);
        SunhillSiteManager::addAjaxModule('objectfield', AjaxObjectField::class);
    }
    
    public function boot()
    {
        $this->loadJSONTranslationsFrom(__DIR__.'/../resources/lang');
        $this->loadViewsFrom(__DIR__.'/../resources/views','collection');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        
        Blade::component('collection-input', Input::class);
        Blade::component('collection-lookup', Lookup::class);

        $this->registerClasses();
        $this->registerCollections();
        $this->registerAjax();
        $this->defineDialogs();
    }
}
