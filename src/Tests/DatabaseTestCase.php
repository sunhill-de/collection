<?php

namespace Sunhill\Collection\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\SunhillSiteManager;
use Sunhill\Collection\Tests\Database\Seeders\DatabaseSeeder;

use Sunhill\Collection\Modules\Database\SunhillFeatureClasses;
use Sunhill\Collection\Modules\Database\SunhillFeatureObjects;
use Sunhill\Collection\Modules\Database\SunhillFeatureTags;
use Sunhill\Collection\Modules\Database\SunhillFeatureAttributes;
use Sunhill\Collection\Modules\Database\SunhillFeatureImports;

class DatabaseTestCase extends TestCase
{
    
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
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
        Classes::migrateClasses();
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
    
   
}