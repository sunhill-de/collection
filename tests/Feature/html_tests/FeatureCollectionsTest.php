<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

use Sunhill\ORM\Facades\Collections;

class FeatureCollectionsTest extends HtmlTestBase
{
    
    /**
     * @dataProvider CollectionProvider
     */
    public function testListCollection($collection, $entries = [])
    {
        $response = $this->get('/Database/Collections/ListCollection/'.$collection);
        $response->assertStatus(200);        
        foreach ($entries as $key => $value) {
            $response->assertSee($value);
        }
    }

    /**
     * @dataProvider CollectionProvider
     */
    public function testAddCollection($collection)
    {
        $response = $this->get('/Database/Collections/Add/'.$collection);
        $response->assertStatus(200);        
    }
    
    /**
     * @dataProvider CollectionProvider
     */
    public function testEditCollection($collection, $entries)
    {
        $response = $this->get('/Database/Collections/Edit/'.$collection.'/1');
        $response->assertStatus(200);
    }
    
    /**
     * @dataProvider CollectionProvider
     */
    public function testShowCollection($collection, $entries)
    {
        $response = $this->get('/Database/Collections/Show/'.$collection.'/1');
        $response->assertStatus(200);
        foreach ($entries as $key => $value) {
            $response->assertSee($value);            
        }
    }
    
    /**
     * @dataProvider CollectionProvider
     */
    public function testDeleteCollection($collection, $entries, $dataset)
    {
        $table = Collections::searchCollection($collection)::getInfo('table');
        $this->assertDatabaseHas($table, array_merge(['id'=>1], $dataset));
        $response = $this->get('/Database/Collections/DeleteCollection/1');
        $response->assertStatus(200);
        $this->assertDatabaseMissing($table, array_merge(['id'=>1], $dataset));
    }
    
    public static function CollectionProvider()
    {
        return [
            [
                'Anniversary',
                ["Homer's birthday"],
                ['name'=>"Homer's birthday",'type'=>'birthday','first'=>'1956-05-12'],                
            ],
 /*          
            ['Event',['Homer Simpson',['who']]],
            ['EventType',['name'=>'watch']],
            ['Genre',['name'=>'fiction']],
            ['Language',['name'=>'english']],
            ['MusicalArtist',['name'=>'Muse']],
            ['Network',['name'=>'home']],
            ['PersonsRelation',['person1'=>'Homer Simpson','person2'=>'Marge Simpson']],
            ['ProductGroup',['name'=>'food']],
            ['Staff',['person'=>'Edward Norton']],
            ['StaffJob',['name'=>'actor']], */
        ];    
    }
    
    public static function HTMLProvider()
    {
        return [
 /*           ['/Database/Collections/List',200,'get','Anniversary'],          // Default list classes
            ['/Database/Collections/Show/Anniversary',200],   // Show class with existing name
            
            ['/Database/Collections/Show/NonExistingClass',500],  // Show non existing class
            ['/Database/Collections/List/1000',500],              // List classes with non existing page
            ['/Database/Collections/ListCollection/StaffJob',200],
            ['/Database/Collections/ListCollection/MusicalArtist/0',200],
            ['/Database/Collections/ListCollection/MusicalArtist/0/id',200],
            ['/Database/Collections/ListCollection/MusicalArtist/1/id',200],
            ['/Database/Collections/ListCollection/StaffJob/1000',500],
   */     ];    
    }
    
}