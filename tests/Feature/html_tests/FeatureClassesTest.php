<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

use Sunhill\Collection\Tests\DatabaseTestCase;

class FeatureClassesTest extends DatabaseTestCase
{
    
    use ClassProvider;
    
    public function testListDefaultPage0()
    {
        $response = $this->get('/Database/Classes/List/');
        $response->assertStatus(200);
        $response->assertSee('Address');
    }
    
    public function testListDefault()
    {
        $response = $this->get('/Database/Classes/List/0');
        $response->assertStatus(200);
        $response->assertSee('Address');
    }
    
    public function testListPage()
    {
        $response = $this->get('/Database/Classes/List/1');
        $response->assertStatus(200);        
        $response->assertSee('Episode');
    }
    
    public function testListLastPage()
    {
        $response = $this->get('/Database/Classes/List/-1');
        $response->assertStatus(200);
        $response->assertSee('WrittenWork');
    }
    
    public function testListNoPage()
    {
        $response = $this->get('/Database/Classes/List/1000');
        $response->assertStatus(500);
        $response->assertSee("is out of range.");
    }

    public function testListsOrder()
    {
        $response = $this->get('/Database/Classes/List/0/name');
        $response->assertStatus(200);
        $response->assertSee("object");
    }
    
    public function testListNoOrder()
    {
        $response = $this->get('/Database/Classes/List/0/nonexisting');
        $response->assertStatus(500);        
        $response->assertSee("'nonexisting' is not an allowed order key.");
    }
    
    public function testListCombined()
    {
        $response = $this->get('/Database/Classes/List/1/name');
        $response->assertStatus(200);
        $response->assertSee("Person");
    }

    /**
     * @dataProvider ClassProvider
     */
    public function testShow($class)
    {
        $response = $this->get('/Database/Classes/Show/'.$class);
        $response->assertStatus(200);
        $response->assertSee($class);
    }
        
    public function testShowMissing()
    {
        $response = $this->get('/Database/Classes/Show/notexisting');
        $response->assertStatus(500);
        $response->assertSee("The ID 'notexisting' is not a valid ID.");
    }
        
}