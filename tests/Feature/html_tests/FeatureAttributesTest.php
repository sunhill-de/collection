<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

class FeatureAttributesTest extends HtmlTestBase
{
    
    public static function HTMLProvider()
    {
        return [
            ['/Database/Attributes/List',200],       // List attributes
            ['/Database/Attributes/Add', 200],       // Add attribute
            ['/Database/Attributes/Edit/1', 200],    // Edit attribute
            
            ['/Database/Attributes/List/1000',500],  // List attributes with an invalid index
            ['/Database/Attributes/Edit/1000',500],  // Edit a nonexistant attribute
        ];    
    }
   
    public function testAddAttribute()
    {
        $response = $this->post('/Database/Attributes/ExecAdd',['name'=>'Futurama','type'=>'integer','allowed_classes'=>['CreativeWork']]);        
        $this->assertDatabaseHas('attributes',['name'=>'Futurama']);
        $response->assertRedirect('/Database/Attributes/List');
    }
    
    public function testDeleteAttribute()
    {
        $this->assertDatabaseHas('attributes',['name'=>'wikipedia']);
        $response = $this->get('/Database/Attributes/Delete/1');
        $this->assertDatabaseMissing('attributes',['name'=>'wikipedia']);
    }
    
    public function testEditAttribute()
    {
        $this->assertDatabaseHas('attributes',['name'=>'wikipedia']);
        $response = $this->post('/Database/Attributes/ExecEdit/1',['name'=>'en_wikipedia']);
        $response->assertRedirect('/Database/Attributes/List');
        $this->assertDatabaseHas('attributes',['name'=>'en_wikipedia']);
    }
    
}