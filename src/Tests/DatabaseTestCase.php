<?php

namespace Sunhill\Collection\Tests;

use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\SunhillSiteManager;

use Sunhill\Collection\Modules\Database\SunhillFeatureClasses;
use Sunhill\Collection\Modules\Database\SunhillFeatureObjects;
use Sunhill\Collection\Modules\Database\SunhillFeatureTags;
use Sunhill\Collection\Modules\Database\SunhillFeatureAttributes;
use Sunhill\Collection\Modules\Database\SunhillFeatureImports;

use Sunhill\Collection\Objects\FamilyMember;
use Sunhill\Collection\Collections\Language;
use Sunhill\ORM\Facades\Collections;

use Sunhill\Collection\Collections\Genre;
use Sunhill\Collection\Collections\EventType;

use Sunhill\Collection\Objects\Creative\Movie;
use Sunhill\Collection\Objects\Locations\Country;
use Sunhill\Collection\Objects\Creative\TVSeries;
use Sunhill\Collection\Objects\Locations\City;
use Sunhill\Collection\Objects\Locations\Street;
use Sunhill\Collection\Objects\Locations\Address;

class DatabaseTestCase extends CollectionTestCase
{
    
    
    public function setUp(): void
    {
        parent::setUp();
        $this->migrateSunhill();
        $this->seedDatabase();
    }
    
    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../vendor/sunhill/orm/database/migrations'));
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../../tests/Database/migrations');
    }
    
    protected function migrateSunhill()
    {
        Classes::migrateClasses();
        Collections::migrateCollections();
    }
    
    protected function getEnvironmentSetUp($app)
    {
        SunhillSiteManager::setName('Testsite');
        SunhillSiteManager::setDisplayName('Testsite');
        SunhillSiteManager::setDescription('Mainpage');
        SunhillSiteManager::addIndex(\App\Http\Controllers\IndexController::class);
        //     SunhillSiteManager::addIndex('IndexController');
        
        SunhillSiteManager::addDefaultSubmodule('Database','Database','Database',function($owner) {
            $owner->addSubmodule(new SunhillFeatureClasses());
            $owner->addSubmodule(new SunhillFeatureObjects());
            $owner->addSubmodule(new SunhillFeatureTags());
            $owner->addSubmodule(new SunhillFeatureAttributes());
            $owner->addSubmodule(new SunhillFeatureImports());
        });
            SunhillSiteManager::installRoutes();
    }
    
    protected function seedDatabase()
    {
        $germany = Country::seed([['name'=>'germany','iso_code'=>'D']]);
        $france  = Country::seed([['name'=>'france','iso_code'=>'F']]);
        $spain = Country::seed([['name'=>'spain','iso_code'=>'E']]);
        $usa = Country::seed([['name'=>'U.S.A.','iso_code'=>'USA']]);
        $gb = Country::seed([['name'=>'Great Britain','iso_code'=>'GB']]);
        
        $springfield = City::seed([['name'=>'Springfield','part_of'=>$usa]]);
        $berlin = City::seed([['name'=>'Berlin','part_of'=>$germany]]);
        $madrid = City::seed([['name'=>'Madrid','pard_of'=>$spain]]);
        
        $evergreen = Street::seed([['name'=>'Evergreen Terrace','part_of'=>$springfield]]);
        $kudamm = Street::seed([['name'=>'Kufürstendamm', 'part_of'=>$berlin]]);
        
        $simpsons = Address::seed([['house_number'=>'742']]);
        
        $english = Language::seed([['name'=>'english','iso'=>'en','translations'=>['en'=>'english','de'=>'englisch']]]);
        $german  = Language::seed([['name'=>'german','iso'=>'de','translations'=>['en'=>'german','de'=>'deutsch']]]);
        $french  = Language::seed([['name'=>'french','iso'=>'fr','translations'=>['en'=>'french','de'=>'französich']]]);
        $spanish = Language::seed([['name'=>'spanish','iso'=>'es','translations'=>['en'=>'spanish','de'=>'spanisch']]]);
        
        $lost = TVSeries::seed(
            [
                'name'=>'Lost',
                'original_name'=>'Lost',
                'sort_name'=>'LOST',
                'item_count'=>121,
                'imdb_id'=>'tt411008',
                'tmdb_id'=>'/tv/4609-lost',
                'number_of_episodes'=>121,
                'number_of_seasons'=>6
            ]);
        Movie::seed(
            [
                [
                    'name'=>'Fight Club',
                    'original_name'=>'Fight Club',
                    'sort_name'=>'FIGHTCLUB',
                    'release_date'=>'1999-11-11',
                    'language'=>$english,
                    'countries'=>[$usa],
                    'length'=>139,
                    'imdb_id'=>'tt0137523',
                    'tmdb_id'=>'/movie/550-fight-club',
                    'keywords'=>['fight','anarchy']
                ],    
                [
                    'name'=>'Die Stadt der verlorenen Kinder',
                    'original_name'=>'La Cité des Enfants Perdus',
                    'sort_name'=>'STADTDERVERLORENENKINDER, DIE',
                    'release_date'=>'1995-08-17',
                    'language'=>$french,
                    'countries'=>[$france],    
                    'length'=>112,
                    'imdb_id'=>'tt0112682',
                    'tmdb_id'=>'/movie/902-la-cite-des-enfants-perdus',
                    'keywords'=>['dystopia', 'steampunk']
                ],
            ]);
        
        $watch_event  = EventType::seed([['name'=>'watch','translations'=>['en'=>'watch','de'=>'sehen']]]);
        $change_event = EventType::seed([['name'=>'change','translations'=>['en'=>'change','de'=>'ändern']]]);
        $switch_event = EventType::seed([['name'=>'switch','translations'=>['en'=>'switch','de'=>'umschalten']]]);
        
        $fiction = Genre::seed([
            [
                'name'=>'fiction',
                'media_type'=>['VisualWork','WrittenWork'],
                'translations'=>['en'=>'fiction','de'=>'Fiktion']
            ]
        ]);
        $nonfiction = Genre::seed([
            [
                'name'=>'nonfiction',
                'media_type'=>['VisualWork','WrittenWork'],
                'translations'=>['en'=>'nonfiction','de'=>'Nichtfiktion']
            ]
        ]);
        Genre::seed([
            [
                'name'=>'science fiction',
                'media_type'=>['VisualWork','WrittenWork'],
                'translations'=>['en'=>'science fiction','de'=>'Science fiction'],
                'parent'=>$fiction
            ],
            [
                'name'=>'drama',
                'media_type'=>['VisualWork','WrittenWork'],
                'translations'=>['en'=>'drama','de'=>'Drama'],
                'parent'=>$fiction
            ],            
            [
                'name'=>'horror',
                'media_type'=>['VisualWork','WrittenWork'],
                'translations'=>['en'=>'horror','de'=>'Horror'],
                'parent'=>$fiction
            ],
            [
                'name'=>'computer',
                'media_type'=>['WrittenWork'],
                'translations'=>['en'=>'computer','de'=>'Computer'],
                'parent'=>$nonfiction
            ],
            [
                'name'=>'programming',
                'media_type'=>['VisualWork','WrittenWork'],
                'translations'=>['en'=>'programming','de'=>'Programmierung'],
                'parent'=>$nonfiction
            ],
        ]);
        
        $homer = FamilyMember::seed([['firstname'=>'Homer','middlename'=>'Jay','lastname'=>'Simpson','sex'=>'male','date_of_birth'=>"1956-05-12",'address'=>$simpsons]]);
        $marge = FamilyMember::seed([['firstname'=>'Marge','lastname'=>'Simpson','sex'=>'female',"birth_name"=>"Bouvier",'address'=>$simpsons]]);
        $bart = FamilyMember::seed([['firstname'=>"Bart","lastname"=>"Simpson","sex"=>"male","date_of_birth"=>"1980-02-23",'father'=>$homer,'mother'=>$marge,'address'=>$simpsons]]);
        $lisa = FamilyMember::seed([['firstname'=>"Lisa","lastname"=>"Simpson","sex"=>"female","date_of_birth"=>"1981-05-09",'father'=>$homer,'mother'=>$marge,'address'=>$simpsons]]);
        $maggie = FamilyMember::seed([['firstname'=>"Maggie","lastname"=>"Simpson","sex"=>"female",'father'=>$homer,'mother'=>$marge,'address'=>$simpsons]]);
    }
    
}