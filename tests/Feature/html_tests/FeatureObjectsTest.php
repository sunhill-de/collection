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
    
 
    public function HTMLProvider()
    {
        return [
            ['/Database/Objects/List',200],
            ['/Database/Objects/Show/1',200],
            ['/Database/Objects/Add/Country',200],
            
            ['/Database/Objects/Show/10000',500],
            ['/Database/Objects/Add/Object',500],
            ['/Database/Objects/Add/NonExistingClass',500],
            ['/Database/Objects/Delete/10000',500],
            ['/Database/Objects/Edit/10000',500],
            ['/Database/Objects/ExecEdit/10000',500,'post'],
        ];
    }
    
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
}