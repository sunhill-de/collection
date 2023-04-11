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

class FeatureObjectsTest extends DatabaseTestCase
{
    
    /**
     * @dataProvider checkFor200Provider
     */
    public function testCheckFor200($route)
    {
        $response = $this->get($route);        
        $response->assertStatus(200);        
    }
    
    public function checkFor200Provider()
    {
        return [
            ['/Database/Objects/List'], 
            ['/Database/Objects/Show/1'],
        ];
    }
    
    /**
     * @dataProvider checkFor500Provider
     */
    public function testCheckForUsererror($route)
    {
        $response = $this->get($route);
        $response->assertSeeText(__('User error'));
    }
    
    public function checkFor500Provider()
    {
        return [
            ['/Database/Objects/Show/10000'],
        ];        
    }
}