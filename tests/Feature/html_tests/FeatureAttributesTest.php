<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

use Sunhill\Collection\Tests\DatabaseTestCase;

class FeatureAttributesTest extends DatabaseTestCase
{
    
    public function testListDefaultPage0()
    {
        $response = $this->get('/Database/Attributes/List/');
        $response->assertStatus(200);
        $response->assertSee('rating');
    }
    
    public function testListDefault()
    {
        $response = $this->get('/Database/Attributes/List/0');
        $response->assertStatus(200);
        $response->assertSee('rating');
    }
    
    public function testListPage()
    {
        $response = $this->get('/Database/Attributes/List/1');
        $response->assertStatus(200);        
        $response->assertSee('hair');
    }
    
    public function testListLastPage()
    {
        $response = $this->get('/Database/Attributes/List/-1');
        $response->assertStatus(200);
        $response->assertSee('hair');
    }
    
    public function testListNoPage()
    {
        $response = $this->get('/Database/Attributes/List/1000');
        $response->assertStatus(500);
        $response->assertSee("The index '1000' is out of range.");
    }

    public function testListsOrder()
    {
        $response = $this->get('/Database/Attributes/List/0/name');
        $response->assertStatus(200);
        $response->assertSee("else");
    }
    
    public function testListNoOrder()
    {
        $response = $this->get('/Database/Attributes/List/0/nonexisting');
        $response->assertStatus(500);        
        $response->assertSee("Can't order by 'nonexisting'.");
    }
    
    public function testListCombined()
    {
        $response = $this->get('/Database/Attributes/List/1/name');
        $response->assertStatus(200);
        $response->assertSee("wikipedia");
    }
    
    public function testShow()
    {
        $response = $this->get('/Database/Attributes/Show/1');
        $response->assertStatus(200);
    }
        
    public function testShowMissing()
    {
        $response = $this->get('/Database/Attributes/Show/1000');
        $response->assertStatus(500);
        $response->assertSee("The ID '1000' does not exist.");
    }
    
    public function testAdd()
    {
        $response = $this->get('/Database/Attributes/Add');
        $response->assertStatus(200);
        $response->assertSee("Name");
    }
    
    public function testExecAdd()
    {
        $response = $this->post('/Database/Attributes/ExecAdd', ['name'=>'addtest','type'=>'integer','allowed_objects'=>['Person']]);
        $response->assertStatus(200);        
        $response->assertSee("addtest");
        $this->assertDatabaseHas('attributes',['name'=>'addtest']);
    }
    
    public function testExecAddMissing()
    {
        $response = $this->post('/Database/Attributes/ExecAdd', ['type'=>'integer','allowed_objects'=>['Person']]);
        $response->assertStatus(200);        
        $response->assertSee("This field is required.");
    }
    
    public function testExecAddDuplicate()
    {
        $response = $this->post('/Database/Attributes/ExecAdd', ['name'=>'rating','type'=>'integer','allowed_objects'=>['Person']]);
        $response->assertStatus(200);        
        $response->assertSee("This field is a duplicate.");
    }
    
    public function testEdit()
    {
        $response = $this->get('/Database/Attributes/Edit/1');
        $response->assertStatus(200);
    }
    
    public function testEditMissing()
    {
        $response = $this->get('/Database/Attributes/Edit/1000');
        $response->assertStatus(500);
        $response->assertSee("The ID '1000' does not exist.");
    }
    
    public function testExecEdit()
    {
        $response = $this->post('/Database/Attributes/ExecEdit/1',['name'=>'Wukupedia']);
        $response->assertStatus(200);
        $this->assertDatabaseHas('attributes',['id'=>1,'name'=>'Wukumedia']);
    }
    
    public function testExecEditMissingID()
    {
        $response = $this->post('/Database/Attributes/ExecEdit/1000',['name'=>'Wukupedia']);
        $response->assertStatus(500);
        $response->assertSee("The ID '1000' does not exist.");        
    }
    
    public function testExecEditMissingName()
    {
        $response = $this->post('/Database/Attributes/ExecEdit/1',['name'=>'']);
        $response->assertStatus(200);
        $response->assertSee('This field is required.');
    }
    
    public function testExecEditDuplicate()
    {
        $response = $this->post('/Database/Attributes/ExecEdit/1',['name'=>'rating']);
        $response->assertStatus(200);
        $response->assertSee('This field is a duplcate.');        
    }
    
    public function testDelete()
    {
        $response = $this->get('/Database/Attributes/Delete/1');
        $response->assertStatus(200);
        $this->assertDatabaseMissing('attributes',['name'=>'wikipedia']);
    }
    
    public function testDeleteMissing()
    {
        $response = $this->get('/Database/Attributes/Delete/1000');
        $response->assertStatus(500);
        $response->assertSee("The ID '1000' does not exist.");        
    }
}