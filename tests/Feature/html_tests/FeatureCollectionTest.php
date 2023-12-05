<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

use Sunhill\Collection\Tests\DatabaseTestCase;

class FeatureCollectionTest extends DatabaseTestCase
{
    
    use CollectionProvider;
    
    /**
     * @dataProvider CollectionProvider
     * @param unknown $collection
     */
    public function testListDefaultPage0($collection)
    {
        $response = $this->get('/Database/Collection/List/'.$collection);
        $response->assertStatus(200);
    }
    
    public function testListDefault()
    {
        $response = $this->get('/Database/Collection/List/Anniversary/0');
        $response->assertStatus(200);
    }
    
    public function testListPage()
    {
        $response = $this->get('/Database/Collection/List/MusicalArtist/1');
        $response->assertStatus(200);        
    }
    
    public function testListLastPage()
    {
        $response = $this->get('/Database/Collection/List/MusicalArtist/-1');
        $response->assertStatus(200);
    }
    
    public function testListNoPage()
    {
        $response = $this->get('/Database/Collection/List/MusicalArtist/1000');
        $response->assertStatus(500);
        $response->assertSee("is out of range.");
    }

    public function testListsOrder()
    {
        $response = $this->get('/Database/Collection/List/MusicalArtist/0/name');
        $response->assertStatus(200);
        $response->assertSee("Ash");
    }
    
    public function testListNoOrder()
    {
        $response = $this->get('/Database/Collection/List/MusicalArtist/0/nonexisting');
        $response->assertStatus(500);        
        $response->assertSee("'nonexisting' is not an allowed order key.");
    }
    
    public function testListCombined()
    {
        $response = $this->get('/Database/Collection/List/MusicalArtist/1/name');
        $response->assertStatus(200);
        $response->assertSee("Muse");
    }
    
    /**
     * @dataProvider CollectionProvider
     * @group show
     */
    public function testShow($collection, $expect = null)
    {
        if ($collection == 'Transaction') {
            $this->assertTrue(true);
            return;
            // @todo remove me when transactions are done
        }
        $response = $this->get('/Database/Collection/Show/'.$collection.'/1');
        $response->assertStatus(200);
        if ($expect) {
            foreach ($expect as $expectation) {
                $response->assertSee($expectation);
            }
        }
    }
        
    public function testShowMissing()
    {
        $response = $this->get('/Database/Collection/Show/MusicalArtist/1000');
        $response->assertStatus(500);
        $response->assertSee("The ID '1000' is not a valid ID.");
    }
    
    /**
     * @dataProvider CollectionProvider
     * @group add
     */
    public function testAdd($collection, $expect_see = null, $expect_fields = null)
    {
        $response = $this->get('/Database/Collection/Add/'.$collection);
        $response->assertStatus(200);
        if ($expect_fields) {
            foreach ($expect_fields as $expectation) {
                $response->assertSee($expectation);
            }
        }
    }
    
    public function testExecAdd($collection, $expect_see = null, $expect_field = null, $add_fields)
    {
        $response = $this->post('/Database/Collection/ExecAdd/'.$collection, $add_fields);
        $response->assertRedirectToRoute('tags.list',['page'=>-1,'order'=>'id']);        
        $this->assertDatabaseHas('tags',['name'=>'testtag']);
    }
    
    public function testExecAddMissing()
    {
        $response = $this->post('/Database/Collection/ExecAdd', ['name'=>'']);
        $response->assertStatus(200);        
        $response->assertSee("This field is required.");
    }
    
    public function testExecAddDuplicate()
    {
        $response = $this->post('/Database/Collection/ExecAdd', ['name'=>'Family']);
        $response->assertStatus(200);        
        $response->assertSee("This field is a duplicate.");
    }
    
    public function testEdit()
    {
        $response = $this->get('/Database/Collection/Edit/1');
        $response->assertStatus(200);
    }
    
    public function testEditMissing()
    {
        $response = $this->get('/Database/Collection/Edit/1000');
        $response->assertStatus(500);
        $response->assertSee("The ID '1000' is not a valid ID.");
    }
    
    public function testExecEdit()
    {
        $response = $this->post('/Database/Collection/ExecEdit/1',['name'=>'Wukupedia']);
        $response->assertRedirectToRoute('tags.list');
        $this->assertDatabaseHas('tags',['id'=>1,'name'=>'Wukupedia']);
    }
    
    public function testExecEditMissingID()
    {
        $response = $this->post('/Database/Collection/ExecEdit/1000',['name'=>'Wukupedia']);
        $response->assertStatus(500);
        $response->assertSee("The ID '1000' is not a valid ID.");        
    }
    
    public function testExecEditMissingName()
    {
        $response = $this->post('/Database/Collection/ExecEdit/1',['name'=>'']);
        $response->assertStatus(200);
        $response->assertSee('This field is required.');
    }
    
    public function testExecEditDuplicate()
    {
        $this->markTestSkipped("Does not work for some reasons.");
        $response = $this->post('/Database/Collection/ExecEdit/1',['name'=>'Springfield']);
        $response->assertStatus(200);
        $response->assertSee('This field is a duplicate.');        
    }
    
    public function testDelete()
    {
        $response = $this->get('/Database/Collection/Delete/1');
        $this->assertDatabaseMissing('tags',['name'=>'Family']);
        $response->assertRedirectToRoute('tags.list');
    }
    
    public function testDeleteMissing()
    {
        $response = $this->get('/Database/Collection/Delete/1000');
        $response->assertStatus(500);
        $response->assertSee("The ID '1000' is not a valid ID.");        
    }
    
    public function testGroupDelete()
    {
        $response = $this->post('/Database/Collection/ConfirmGroupDelete',['selected'=>[2,3]]);
        $response->assertSee('Homer');
    }
    
    public function testExecGroupDelete()
    {
        $response = $this->post('/Database/Collection/ExecGroupDelete',['selected'=>[2,3]]);
        $response->assertRedirectToRoute('tags.list');
        $this->assertDatabaseMissing('tags',['id'=>2]);
        $this->assertDatabaseMissing('tags',['id'=>3]);
        $this->assertDatabaseHas('tags',['id'=>1]);
    }
    
    public function testGroupEdit()
    {
        $response = $this->post('/Database/Collection/GroupEdit',['selected'=>[2,3]]);
        $response->assertStatus(200);        
    }
    
    public function testExecGroupEdit()
    {
        $response = $this->post('/Database/Collection/ExecGroupEdit',['selected'=>[2,3],'leafable'=>1]);
        $response->assertRedirectToRoute('tags.list');
    }
    
}