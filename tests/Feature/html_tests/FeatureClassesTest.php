<?php

use Sunhill\Collection\Tests\CollectionTestCase;

use Sunhill\Visual\Facades\SunhillSiteManager;
use Sunhill\Collection\Modules\Database\SunhillFeatureClasses;
use Sunhill\Collection\Modules\Database\SunhillFeatureObjects;
use Sunhill\Collection\Modules\Database\SunhillFeatureTags;
use Sunhill\Collection\Modules\Database\SunhillFeatureAttributes;
use Sunhill\Collection\Modules\Database\SunhillFeatureImports;

class FeatureClassesTest extends CollectionTestCase
{
    
    public function setUp(): void
    {
        parent::setUp();    
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
    
    /**
     * @dataProvider checkFor200Provider
     * @param unknown $route
     */
    public function testCheckFor200($route)
    {
        $response = $this->get($route);        
        $response->assertStatus(200);        
    }
    
    public function checkFor200Provider()
    {
        return [
           ['/Database/Classes/List'] 
        ];
    }
}