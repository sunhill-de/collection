<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

use Sunhill\Collection\Tests\DatabaseTestCase;

class FeatureCollectionsTest extends DatabaseTestCase
{
    
    use CollectionProvider;
    
    public function testListDefaultPage0()
    {
        $response = $this->get('/Database/Collections/List');
        $response->assertStatus(200);
        $response->assertSee('Anniversary');
    }
    
    public function testListDefault()
    {
        $response = $this->get('/Database/Collections/List/0');
        $response->assertStatus(200);
        $response->assertSee('Anniversary');
    }
    
/* There is only one page yet   
 * public function testListPage()
    {
        $response = $this->get('/Database/Collections/List/1');
        $response->assertStatus(200);        
        $response->assertSee('Episode');
    }
*/    
    public function testListLastPage()
    {
        $response = $this->get('/Database/Collections/List/-1');
        $response->assertStatus(200);
        $response->assertSee('Transaction');
    }
    
    public function testListNoPage()
    {
        $response = $this->get('/Database/Collections/List/1000');
        $response->assertStatus(500);
        $response->assertSee("is out of range.");
    }

    public function testListsOrder()
    {
        $response = $this->get('/Database/Collections/List/0/name');
        $response->assertStatus(200);
        $response->assertSee("Event");
    }
    
    public function testListNoOrder()
    {
        $response = $this->get('/Database/Collections/List/0/nonexisting');
        $response->assertStatus(500);        
        $response->assertSee("'nonexisting' is not an allowed order key.");
    }
/*    
    public function testListCombined()
    {
        $response = $this->get('/Database/Collections/List/1/name');
        $response->assertStatus(200);
        $response->assertSee("Person");
    }
*/  
    /**
     * @dataProvider CollectionProvider
     */
    public function testShow($collection)
    {
        $response = $this->get('/Database/Collections/Show/'.$collection);
        $response->assertStatus(200);
        $response->assertSee($collection);
    }
        
    public function testShowMissing()
    {
        $response = $this->get('/Database/Collections/Show/notexisting');
        $response->assertStatus(500);
        $response->assertSee("The ID 'notexisting' is not a valid ID.");
    }
        
}