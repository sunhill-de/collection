<?php

namespace Sunhill\Collection\Tests;

use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\SunhillSiteManager;

use Sunhill\Collection\Modules\Database\SunhillFeatureClasses;
use Sunhill\Collection\Modules\Database\SunhillFeatureObjects;
use Sunhill\Collection\Modules\Database\SunhillFeatureTags;
use Sunhill\Collection\Modules\Database\SunhillFeatureAttributes;
use Sunhill\Collection\Modules\Database\SunhillFeatureImports;

use Sunhill\ORM\Facades\Collections;
use Sunhill\Collection\Modules\Database\SunhillFeatureCollections;
use Sunhill\Collection\Modules\Database\SunhillFeatureCollection;

class DatabaseTestCase extends CollectionTestCase
{
    
    
    public function setUp(): void
    {
        parent::setUp();
        $this->migrateSunhill();
        $seeder = new BasicSeeder();
        $seeder->seedDatabase();
    }
    
    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../vendor/sunhill/orm/database/migrations'));
        $this->loadMigrationsFrom(realpath(__DIR__.'/../../vendor/sunhill/visual/database/migrations'));
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
            $owner->addSubmodule(new SunhillFeatureCollections());
            $owner->addSubmodule(new SunhillFeatureCollection());
            $owner->addSubmodule(new SunhillFeatureObjects());
            $owner->addSubmodule(new SunhillFeatureTags());
            $owner->addSubmodule(new SunhillFeatureAttributes());
            $owner->addSubmodule(new SunhillFeatureImports());
        });
            SunhillSiteManager::installRoutes();
    }

    
}