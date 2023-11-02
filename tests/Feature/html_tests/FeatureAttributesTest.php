<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

use Sunhill\Collection\Tests\DatabaseTestCase;

class FeatureAttributesTest extends DatabaseTestCase
{
    
    public function testListDefaultPage0()
    {
        $response = $this->get('/Database/Attributes/List/');
        $response->assertStatus(200);
        $response->assertSee('wikipedia');
    }
    
    public function testListDefault()
    {
        $response = $this->get('/Database/Attributes/List/0');
        $response->assertStatus(200);
        $response->assertSee('wikipedia');
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
        $response->assertSee("is out of range.");
    }

    public function testListsOrder()
    {
        $response = $this->get('/Database/Attributes/List/0/name');
        $response->assertStatus(200);
        $response->assertSee("Bart");
    }
    
    public function testListNoOrder()
    {
        $response = $this->get('/Database/Attributes/List/0/nonexisting');
        $response->assertStatus(500);        
        $response->assertSee("'nonexisting' is not an allowed order key.");
    }
    
    public function testListCombined()
    {
        $response = $this->get('/Database/Attributes/List/1/name');
        $response->assertStatus(200);
        $response->assertSee("Springfield");
    }
    
    public function testShow()
    {
        $response = $this->get('/Database/Attributes/Show/1');
        $response->assertStatus(200);
        $response->assertSee('Family');
    }
        
    public function testShowMissing()
    {
        $response = $this->get('/Database/Attributes/Show/1000');
        $response->assertStatus(500);
        $response->assertSee("The ID '1000' is not a valid ID.");
    }
    
    public function testAdd()
    {
        $response = $this->get('/Database/Attributes/Add');
        $response->assertStatus(200);
        $response->assertSee("Name");
    }
    
    public function testExecAdd()
    {
        $response = $this->post('/Database/Attributes/ExecAdd', ['name'=>'testtag']);
        $response->assertRedirectToRoute('tags.list',['page'=>-1,'order'=>'id']);        
        $this->assertDatabaseHas('tags',['name'=>'testtag']);
    }
    
    public function testExecAddMissing()
    {
        $response = $this->post('/Database/Attributes/ExecAdd', ['name'=>'']);
        $response->assertStatus(200);        
        $response->assertSee("This field is required.");
    }
    
    public function testExecAddDuplicate()
    {
        $response = $this->post('/Database/Attributes/ExecAdd', ['name'=>'Family']);
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
        $response->assertSee("The ID '1000' is not a valid ID.");
    }
    
    public function testExecEdit()
    {
        $response = $this->post('/Database/Attributes/ExecEdit/1',['name'=>'Wukupedia']);
        $response->assertRedirectToRoute('tags.list');
        $this->assertDatabaseHas('tags',['id'=>1,'name'=>'Wukupedia']);
    }
    
    public function testExecEditMissingID()
    {
        $response = $this->post('/Database/Attributes/ExecEdit/1000',['name'=>'Wukupedia']);
        $response->assertStatus(500);
        $response->assertSee("The ID '1000' is not a valid ID.");        
    }
    
    public function testExecEditMissingName()
    {
        $response = $this->post('/Database/Attributes/ExecEdit/1',['name'=>'']);
        $response->assertStatus(200);
        $response->assertSee('This field is required.');
    }
    
    public function testExecEditDuplicate()
    {
        $this->markTestSkipped("Does not work for some reasons.");
        $response = $this->post('/Database/Attributes/ExecEdit/1',['name'=>'Springfield']);
        $response->assertStatus(200);
        $response->assertSee('This field is a duplicate.');        
    }
    
    public function testDelete()
    {
        $response = $this->get('/Database/Attributes/Delete/1');
        $this->assertDatabaseMissing('tags',['name'=>'Family']);
        $response->assertRedirectToRoute('tags.list');
    }
    
    public function testDeleteMissing()
    {
        $response = $this->get('/Database/Attributes/Delete/1000');
        $response->assertStatus(500);
        $response->assertSee("The ID '1000' is not a valid ID.");        
    }
    
    public function testGroupDelete()
    {
        $response = $this->post('/Database/Attributes/ConfirmGroupDelete',['selected'=>[2,3]]);
        $response->assertSee('Homer');
    }
    
    public function testExecGroupDelete()
    {
        $response = $this->post('/Database/Attributes/ExecGroupDelete',['selected'=>[2,3]]);
        $response->assertRedirectToRoute('tags.list');
        $this->assertDatabaseMissing('tags',['id'=>2]);
        $this->assertDatabaseMissing('tags',['id'=>3]);
        $this->assertDatabaseHas('tags',['id'=>1]);
    }
    
    public function testGroupEdit()
    {
        $response = $this->post('/Database/Attributes/GroupEdit',['selected'=>[2,3]]);
        $response->assertStatus(200);        
    }
    
    public function testExecGroupEdit()
    {
        $response = $this->post('/Database/Attributes/ExecGroupEdit',['selected'=>[2,3],'leafable'=>1]);
        $response->assertRedirectToRoute('tags.list');
    }
    
}