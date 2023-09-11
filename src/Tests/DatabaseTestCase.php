<?php

namespace Sunhill\Collection\Tests;

use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\SunhillSiteManager;
use Sunhill\Collection\Tests\Database\Seeders\DatabaseSeeder;

use Sunhill\Collection\Modules\Database\SunhillFeatureClasses;
use Sunhill\Collection\Modules\Database\SunhillFeatureObjects;
use Sunhill\Collection\Modules\Database\SunhillFeatureTags;
use Sunhill\Collection\Modules\Database\SunhillFeatureAttributes;
use Sunhill\Collection\Modules\Database\SunhillFeatureImports;
use Sunhill\Collection\Objects\FamilyMember;
use Illuminate\Support\Facades\DB;
use Sunhill\Collection\Collections\Language;
use Sunhill\ORM\Facades\Collections;
use Sunhill\Collection\Collections\Genre;
use Sunhill\Collection\Collections\EventTypes;
use Sunhill\Collection\Collections\EventType;

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
        $watch  = EventType::seed([['name'=>'watch','translations'=>['en'=>'watch','de'=>'sehen']]]);
        $change = EventType::seed([['name'=>'change','translations'=>['en'=>'change','de'=>'ändern']]]);
        $switch = EventType::seed([['name'=>'switch','translations'=>['en'=>'switch','de'=>'umschalten']]]);
        
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
        Language::seed([
            ['name'=>'english','iso'=>'en','translations'=>['en'=>'english','de'=>'englisch']],
            ['name'=>'german','iso'=>'de','translations'=>['en'=>'german','de'=>'deutsch']],
            ['name'=>'french','iso'=>'fr','translations'=>['en'=>'french','de'=>'französich']],
            ['name'=>'spanish','iso'=>'es','translations'=>['en'=>'spanish','de'=>'spanisch']],
        ]);
        
        $homer = FamilyMember::seed([['firstname'=>'Homer','middlename'=>'Jay','lastname'=>'Simpson','sex'=>'male','date_of_birth'=>"1956-05-12"]]);
        $marge = FamilyMember::seed([['firstname'=>'Marge','lastname'=>'Simpson','sex'=>'female',"birth_name"=>"Bouvier"]]);
        $bart = FamilyMember::seed([['firstname'=>"Bart","lastname"=>"Simpson","sex"=>"male","date_of_birth"=>"1980-02-23",'father'=>$homer,'mother'=>$marge]]);
        $lisa = FamilyMember::seed([['firstname'=>"Lisa","lastname"=>"Simpson","sex"=>"female","date_of_birth"=>"1981-05-09",'father'=>$homer,'mother'=>$marge]]);
        $maggie = FamilyMember::seed([['firstname'=>"Maggie","lastname"=>"Simpson","sex"=>"female",'father'=>$homer,'mother'=>$marge]]);
    }
    
}