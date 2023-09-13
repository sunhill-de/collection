<?php

namespace Sunhill\Collection\Tests;

use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\SunhillSiteManager;

use Sunhill\Collection\Modules\Database\SunhillFeatureClasses;
use Sunhill\Collection\Modules\Database\SunhillFeatureObjects;
use Sunhill\Collection\Modules\Database\SunhillFeatureTags;
use Sunhill\Collection\Modules\Database\SunhillFeatureAttributes;
use Sunhill\Collection\Modules\Database\SunhillFeatureImports;

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
use Sunhill\Collection\Collections\ProductGroup;

use Sunhill\Collection\Objects\Persons\Person;
use Sunhill\Collection\Objects\Persons\FamilyMember;

use Sunhill\Collection\Collections\PersonsRelation;
use Sunhill\Collection\Collections\Staff;
use Sunhill\Collection\Collections\StaffJob;

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

    protected function seedProductGroups()
    {
        ProductGroup::seed(['food'=>['name'=>'food']]);
        ProductGroup::seed(['nonfood'=>['name'=>'nonfood']]);
        ProductGroup::seed(['electronics'=>['name'=>'electronics','part_of'=>ProductGroup::getSeedID('nonfood')]]);
        ProductGroup::seed(['computer'=>['name'=>'computer', 'part_of'=>ProductGroup::getSeedID('electronics')]]);
        ProductGroup::seed(['beer'=>['name'=>'beer','part_of'=>ProductGroup::getSeedID('food')]]);        
    }
    
    protected function seedPersons()
    {
        Person::seed([
            'norton'=>['firstname'=>'Edward','lastname'=>'Norton','sex'=>'male','groups'=>['actor']],
            'pitt'=>['firstname'=>'Brad','lastname'=>'Pitt','sex'=>'male','groups'=>['actor']],
            'carter'=>['firstname'=>'Helena','lastname'=>'Bonham Carter','sex'=>'female','groups'=>['actor']],
            'fincher'=>['firstname'=>'David','lastname'=>'Fincher','sex'=>'male','groups'=>['director']]
        ]);            
    }
    
    protected function seedCountries()
    {
        Country::seed([
            'germany'=>['name'=>'germany','iso_code'=>'D'],
            'france'=>['name'=>'france','iso_code'=>'F'],
            'spain'=>['name'=>'spain','iso_code'=>'E'],
            'usa'=>['name'=>'U.S.A.','iso_code'=>'USA'],
            'gb'=>['name'=>'Great Britain','iso_code'=>'GB'],
         ]);   
    }
    
    protected function seedCities()
    {
        City::seed([
            'springfield'=>['name'=>'Springfield','part_of'=>City::getSeedID('usa')],
            'berlin'=>['name'=>'Berlin','part_of'=>City::getSeedID('germany')],
            'madrid'=>['name'=>'Madrid','part_of'=>City::getSeedID('spain')],
        ]);    
    }
    
    protected function seedStreets()
    {
        Street::seed([
            'evergreen'=>['name'=>'Evergreen Terrace','part_of'=>Street::getSeedID('springfield')],
            'kudamm'=>['name'=>'Kufürstendamm', 'part_of'=>Street::getSeedID('berlin')],
        ]);    
    }
    
    protected function seedAddresses()
    {
        Address::seed(['simpsons'=>['name'=>'742 Evergreen Terrace','house_number'=>'742','part_of'=>Street::getSeedID('evergreen')]]);        
    }

    protected function seedLanguages()
    {
        Language::seed([
            'english'=>['name'=>'english','iso'=>'en','translations'=>['en'=>'english','de'=>'englisch']],
            'german'=>['name'=>'german','iso'=>'de','translations'=>['en'=>'german','de'=>'deutsch']],
            'french'=>['name'=>'french','iso'=>'fr','translations'=>['en'=>'french','de'=>'französich']],
            'spanish'=>['name'=>'spanish','iso'=>'es','translations'=>['en'=>'spanish','de'=>'spanisch']],
        ]);        
    }
    
    protected function seedTVSeries()
    {
        TVSeries::seed(
          ['lost'=>[
                'name'=>'Lost',
                'original_name'=>'Lost',
                'sort_name'=>'LOST',
                'item_count'=>121,
                'imdb_id'=>'tt411008',
                'tmdb_id'=>'/tv/4609-lost',
                'number_of_episodes'=>121,
                'number_of_seasons'=>6
           ],               
          ]);
        
    }
    
    protected function seedStaffJobs()
    {
        StaffJob::seed([
            'actor'=>['name'=>'actor'],
            'director'=>['name'=>'director'],
            'guitar'=>['name'=>'lead guitar'],
            'bass'=>['name'=>'bass guitar'],
            'drums'=>['name'=>'drums']
        ]);
    }
    
    protected function seedStaff()
    {
        Staff::seed([
            'narrator'=>[
                'person'=>Staff::getSeedID('norton'),
                'job'=>'actor',
                'additional'=>'Narrator'
            ],
            'durden'=>[
                'person'=>Staff::getSeedID('pitt'),
                'job'=>'actor',
                'additional'=>'Tyler Durden'
            ],
            'singer'=>[
                'person'=>Staff::getSeedID('carter'),
                'job'=>'actor',
                'additional'=>'Marla Singer'
            ],
            'dir_fincher'=>[
                'person'=>Staff::getSeedID('fincher'),
                'job'=>'director',
            ],            
        ]);        
    }
    
    protected function seedMovies()
    {
        Movie::seed(
            [
                [
                    'name'=>'Fight Club',
                    'original_name'=>'Fight Club',
                    'sort_name'=>'FIGHTCLUB',
                    'release_date'=>'1999-11-11',
                    'language'=>Movie::getSeedID('english'),
                    'countries'=>[Movie::getSeedID('usa')],
                    'length'=>139,
                    'imdb_id'=>'tt0137523',
                    'tmdb_id'=>'/movie/550-fight-club',
                    'keywords'=>['fight','anarchy'],
                    'staff'=>[Movie::getSeedID('narrator'),Movie::getSeedID('durden'),Movie::getSeedID('singer'),Movie::getSeedID('dir_fincher')]
                ],
                [
                    'name'=>'Die Stadt der verlorenen Kinder',
                    'original_name'=>'La Cité des Enfants Perdus',
                    'sort_name'=>'STADTDERVERLORENENKINDER, DIE',
                    'release_date'=>'1995-08-17',
                    'language'=>Movie::getSeedID('french'),
                    'countries'=>[Movie::getSeedID('france')],
                    'length'=>112,
                    'imdb_id'=>'tt0112682',
                    'tmdb_id'=>'/movie/902-la-cite-des-enfants-perdus',
                    'keywords'=>['dystopia', 'steampunk']
                ],
            ]);
        
    }
    
    protected function seedEventTypes()
    {
        EventType::seed([
            'watch'=>['name'=>'watch','translations'=>['en'=>'watch','de'=>'sehen']],
            'change'=>['name'=>'change','translations'=>['en'=>'change','de'=>'ändern']],
            'switch'=>['name'=>'switch','translations'=>['en'=>'switch','de'=>'umschalten']]            
        ]);        
    }
    
    protected function seedGenres()
    {
        Genre::seed([
            'fiction'=>[
                'name'=>'fiction',
                'media_type'=>['VisualWork','WrittenWork'],
                'translations'=>['en'=>'fiction','de'=>'Fiktion']
            ],
            'nonfiction'=>[
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
                'parent'=>Movie::getSeedID('fiction')
            ],
            [
                'name'=>'drama',
                'media_type'=>['VisualWork','WrittenWork'],
                'translations'=>['en'=>'drama','de'=>'Drama'],
                'parent'=>Movie::getSeedID('fiction')
            ],
            [
                'name'=>'horror',
                'media_type'=>['VisualWork','WrittenWork'],
                'translations'=>['en'=>'horror','de'=>'Horror'],
                'parent'=>Movie::getSeedID('fiction')
            ],
            [
                'name'=>'computer',
                'media_type'=>['WrittenWork'],
                'translations'=>['en'=>'computer','de'=>'Computer'],
                'parent'=>Movie::getSeedID('nonfiction')
            ],
            [
                'name'=>'programming',
                'media_type'=>['VisualWork','WrittenWork'],
                'translations'=>['en'=>'programming','de'=>'Programmierung'],
                'parent'=>Movie::getSeedID('nonfiction')
            ],
        ]);
        
    }
    
    protected function seedFamilyMembers()
    {
        $homer = FamilyMember::seed([
            'homer'=>['firstname'=>'Homer','middlename'=>'Jay','lastname'=>'Simpson','sex'=>'male','date_of_birth'=>"1956-05-12",'address'=>FamilyMember::getSeedID('simpsons')],            
            'marge'=>['firstname'=>'Marge','lastname'=>'Simpson','sex'=>'female',"birth_name"=>"Bouvier",'address'=>FamilyMember::getSeedID('simpsons')]            
        ]);
        FamilyMember::seed([
            [
                'firstname'=>"Bart",
                "lastname"=>"Simpson",
                "sex"=>"male",
                "date_of_birth"=>"1980-02-23",
                'father'=>FamilyMember::getSeedID('homer'),
                'mother'=>FamilyMember::getSeedID('marge'),
                'address'=>FamilyMember::getSeedID('simpsons')                
            ],
            [
                'firstname'=>"Lisa",
                "lastname"=>"Simpson",
                "sex"=>"female",
                "date_of_birth"=>"1981-05-09",
                'father'=>FamilyMember::getSeedID('homer'),
                'mother'=>FamilyMember::getSeedID('marge'),
                'address'=>FamilyMember::getSeedID('simpsons')                
            ],
            [
                'firstname'=>"Maggie",
                "lastname"=>"Simpson",
                "sex"=>"female",
                'father'=>FamilyMember::getSeedID('homer'),
                'mother'=>FamilyMember::getSeedID('marge'),
                'address'=>FamilyMember::getSeedID('simpsons')                
            ]            
        ]);
        
    }
    
    protected function seedPersonsRelations()
    {
        PersonsRelation::seed([
            [
                'person1'=>FamilyMember::getSeedID('homer'),
                'person2'=>FamilyMember::getSeedID('marge'),
                'relation'=>'marriage'                
            ]
        ]);        
    }
    
    protected function seedDatabase()
    {
        $this->seedProductGroups();
        $this->seedPersons();
        $this->seedCountries();
        $this->seedCities();
        $this->seedStreets();
        $this->seedAddresses();        
        $this->seedLanguages();
        $this->seedTVSeries();
        $this->seedStaffJobs();
        $this->seedStaff();
        $this->seedMovies();
        $this->seedEventTypes();
        $this->seedGenres();
        $this->seedFamilyMembers();
        $this->seedPersonsRelations();
    }
    
}