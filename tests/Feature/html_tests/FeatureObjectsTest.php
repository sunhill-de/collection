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

class FeatureObjectsTest extends HtmlTestBase
{
    
 
    public static function HTMLProvider()
    {
        return [
            ['/Database/Objects/List',200],
            ['/Database/Objects/List/1',200],
            ['/Database/Objects/List/1000',500],
            ['/Database/Objects/List/Address', 200],
            ['/Database/Objects/List/City', 200],
            ['/Database/Objects/List/Country', 200],
            ['/Database/Objects/List/Floor', 200],
            ['/Database/Objects/List/Location', 200],
            ['/Database/Objects/List/Room', 200],
            ['/Database/Objects/List/Street', 200],
            ['/Database/Objects/List/Location/1', 200], // Multiple pages
            ['/Database/Objects/List/Location/1/name', 200], // Different order
            
            ['/Database/Objects/List/Clip', 200],
            ['/Database/Objects/List/CreativeCollection', 200],
            ['/Database/Objects/List/CreativeStandaloneWork', 200],
            ['/Database/Objects/List/CreativeWork', 200],
            ['/Database/Objects/List/Episode', 200],
            ['/Database/Objects/List/Movie', 200],
            ['/Database/Objects/List/MovieSeries', 200],
            ['/Database/Objects/List/TVSeries', 200],
            ['/Database/Objects/List/VisualCollection', 200],
            ['/Database/Objects/List/VisualStandaloneWork', 200],
            ['/Database/Objects/List/WrittenWork', 200],

            ['/Database/Objects/List/AnniversaryCelebration', 200],
            ['/Database/Objects/List/Appointment', 200],
            ['/Database/Objects/List/Celebration', 200],
            ['/Database/Objects/List/Date', 200],
            ['/Database/Objects/List/Trip', 200],
 
            ['/Database/Objects/List/Manufacturer', 200],
            ['/Database/Objects/List/Organisation', 200],
            ['/Database/Objects/List/Shop', 200],
            
            ['/Database/Objects/List/Person', 200],
            ['/Database/Objects/List/Friend', 200],
            ['/Database/Objects/List/FamilyMember', 200],
            
            ['/Database/Objects/List/Computer', 200],
            ['/Database/Objects/List/ElectronicDevice', 200],
            ['/Database/Objects/List/MediaDevice', 200],
            ['/Database/Objects/List/Medium', 200],
            ['/Database/Objects/List/MobileDevice', 200],
            ['/Database/Objects/List/Property', 200],
            ['/Database/Objects/List/Server', 200],
            ['/Database/Objects/List/VideoDevice', 200],
            ['/Database/Objects/List/VisualMedium', 200],
            ['/Database/Objects/List/WrittenMedium', 200],
            
// ********************** Add *********************************
            ['/Database/Objects/Add/Address', 200],
            ['/Database/Objects/Add/City', 200],
            ['/Database/Objects/Add/Country', 200],
            ['/Database/Objects/Add/Floor', 200],
            ['/Database/Objects/Add/Location', 200],
            ['/Database/Objects/Add/Room', 200],
            ['/Database/Objects/Add/Street', 200],
            
            ['/Database/Objects/Add/Clip', 200],
            ['/Database/Objects/Add/CreativeCollection', 200],
            ['/Database/Objects/Add/CreativeStandaloneWork', 200],
            ['/Database/Objects/Add/CreativeWork', 200],
            ['/Database/Objects/Add/Episode', 200],
            ['/Database/Objects/Add/Movie', 200],
            ['/Database/Objects/Add/MovieSeries', 200],
            ['/Database/Objects/Add/TVSeries', 200],
            ['/Database/Objects/Add/VisualCollection', 200],
            ['/Database/Objects/Add/VisualStandaloneWork', 200],
            ['/Database/Objects/Add/WrittenWork', 200],
            
            ['/Database/Objects/Add/AnniversaryCelebration', 200],
            ['/Database/Objects/Add/Appointment', 200],
            ['/Database/Objects/Add/Celebration', 200],
            ['/Database/Objects/Add/Date', 200],
            ['/Database/Objects/Add/Trip', 200],
            
            ['/Database/Objects/Add/Manufacturer', 200],
            ['/Database/Objects/Add/Organisation', 200],
            ['/Database/Objects/Add/Shop', 200],
            
            ['/Database/Objects/Add/Person', 200],
            ['/Database/Objects/Add/Friend', 200],
            ['/Database/Objects/Add/FamilyMember', 200],
            
            ['/Database/Objects/Add/Computer', 200],
            ['/Database/Objects/Add/ElectronicDevice', 200],
            ['/Database/Objects/Add/MediaDevice', 200],
            ['/Database/Objects/Add/Medium', 200],
            ['/Database/Objects/Add/MobileDevice', 200],
            ['/Database/Objects/Add/Property', 200],
            ['/Database/Objects/Add/Server', 200],
            ['/Database/Objects/Add/VideoDevice', 200],
            ['/Database/Objects/Add/VisualMedium', 200],
            ['/Database/Objects/Add/WrittenMedium', 200],
            
/*            ['/Database/Objects/Show/1',200],
            ['/Database/Objects/Add/Country',200],
            
            ['/Database/Objects/Show/10000',500],
            ['/Database/Objects/Add/Object',500],
            ['/Database/Objects/Add/NonExistingClass',500],
            ['/Database/Objects/Delete/10000',500],
            ['/Database/Objects/Edit/10000',500],
            ['/Database/Objects/ExecEdit/10000',500,'post'], */
        ];
    }
 /*   
    public function testAddObject()
    {
        $response = $this->post('/Database/Objects/ExecAdd',['_class'=>'Country','name'=>'Canada']);
        $this->assertDatabaseHas('locations',['name'=>'Canada']);
        $response->assertRedirect('/Database/Objects/List/Country');
    }
    
    public function testDeleteObject()
    {
        $this->assertDatabaseHas('persons',['lastname'=>'King']);
        $response = $this->get('/Database/Objects/Delete/1');
        $this->assertDatabaseMissing('persons',['lastname'=>'King']);
    }
    
    public function testEditObject()
    {
        $this->assertDatabaseHas('locations',['name'=>'Germany']);
        $response = $this->post('/Database/Objects/ExecEdit/11',['name'=>'Deutschland']);
        $response->assertRedirect('/Database/Objects/Show/11');
        $this->assertDatabaseHas('locations',['name'=>'Deutschland']);
    } */
}