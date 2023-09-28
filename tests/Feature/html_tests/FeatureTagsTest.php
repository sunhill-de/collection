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

class FeatureTagsTest extends HtmlTestBase
{
    
 
    public static function HTMLProvider()
    {
        return [
            ['/Database/Tags/List',200],
            ['/Database/Tags/List/0',200],
            ['/Database/Tags/List/1000',500],
            
            ['/Database/Tags/Add',200],
            ['/Database/Tags/Edit/2',200,'get'],
            ['/Database/Tags/Edit/2000',500],
            /*
      * 
      *        
            ['/Database/Tags/Show/1',200],
            ['/Database/Tags/Show/1000',500],
            
            ['/Database/Tags/Add',200],
            ['/Database/Tags/Edit/1',200],
            ['/Database/Tags/Edit/100',500],
            
            ['/Database/Tags/Delete/1',302],
            ['/Database/Tags/Delete/100',500], */            
        ];
    }
    
    public function testAddTag()
    {
        $response = $this->post('/Database/Tags/ExecAdd',['name'=>'Futurama']);
        $this->assertDatabaseHas('tags',['name'=>'Futurama']);
        $response->assertRedirect('/Database/Tags/List');
    }
    
    public function testDeleteTag()
    {
        $this->assertDatabaseHas('tags',['name'=>'Homer']);
        $response = $this->get('/Database/Tags/Delete/2');
        $this->assertDatabaseMissing('tags',['name'=>'Homer']);
    }
    
    public function testEditTag()
    {
        $this->assertDatabaseHas('tags',['name'=>'Family']);
        $response = $this->post('/Database/Tags/ExecEdit/1',['name'=>'Simpsons']);
        $response->assertRedirect('/Database/Tags/List');
        $this->assertDatabaseHas('tags',['name'=>'Simpsons']);
    }
}