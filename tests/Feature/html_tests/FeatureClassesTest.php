<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

use Sunhill\Collection\Tests\CollectionTestCase;

use Sunhill\Visual\Facades\SunhillSiteManager;
use Sunhill\Collection\Modules\Database\SunhillFeatureClasses;
use Sunhill\Collection\Modules\Database\SunhillFeatureObjects;
use Sunhill\Collection\Modules\Database\SunhillFeatureTags;
use Sunhill\Collection\Modules\Database\SunhillFeatureAttributes;
use Sunhill\Collection\Modules\Database\SunhillFeatureImports;
use Sunhill\Collection\Tests\DatabaseTestCase;

class FeatureClassesTest extends DatabaseTestCase
{
    
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