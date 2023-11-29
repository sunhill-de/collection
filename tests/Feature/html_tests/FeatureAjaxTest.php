<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

use Sunhill\Collection\Tests\DatabaseTestCase;

class FeatureAjaxTest extends DatabaseTestCase
{
    
    public function testAjaxAttributesWithoutClass()
    {
        $response = $this->getJson('/ajax/attributes?search=co');
        $response
          ->assertStatus(200)
          ->assertJson([
              ['label'=>'consumed','id'=>7],
              ['label'=>'color','id'=>8],
              ['label'=>'completed','id'=>12],
          ]);          
    }
    
    public function testAjaxAttributesWithClass()
    {
        $response = $this->getJson('/ajax/attributes/Property?search=co');
        $response
        ->assertStatus(200)
        ->assertJson([
            ['label'=>'color','id'=>8],
        ]);
    }
    
    public function testAjaxClasses()
    {
        $response = $this->getJson('/ajax/classes?search=Creative');
        $response
        ->assertStatus(200)
        ->assertJson([
            ['label'=>'CreativeCollection','id'=>'CreativeCollection'],
            ['label'=>'CreativeStandaloneWork','id'=>'CreativeStandaloneWork'],
            ['label'=>'CreativeWork','id'=>'CreativeWork'],            
        ]);
    }

    /**
     * @dataProvider AjaxCollectionFieldProvider
     */
    public function testAjaxCollectionField($collection, $field, $search, $json)
    {
        $response = $this->getJson('/ajax/collectionfield/'.$collection.'/'.$field.'?search='.$search);
        $response->assertStatus(200)->assertJson($json);
    }
    
    public static function AjaxCollectionFieldProvider()
    {
        return [
            ['Anniversary','persons','Bar',[['label'=>'Barney Gumble','id'=>32],['label'=>'Bart Simpson','id'=>37]]],
            ['Event','who','Bar',[['label'=>'Barney Gumble','id'=>32],['label'=>'Bart Simpson','id'=>37]]],
            ['Event','what','wa',[['label'=>'watch','id'=>1]]],
            ['Event','to_whom','Bar',[['label'=>'Barney Gumble','id'=>32],['label'=>'Bart Simpson','id'=>37]]],
            ['Genre','parent','dr',[['label'=>'drama','id'=>4]]],
            ['Network','part_of','ho',[['label'=>'home','id'=>1]]],
            ['PersonsRelation','person1','Bar',[['label'=>'Barney Gumble','id'=>32],['label'=>'Bart Simpson','id'=>37]]],
            ['PersonsRelation','person2','Bar',[['label'=>'Barney Gumble','id'=>32],['label'=>'Bart Simpson','id'=>37]]],
            ['ProductGroup','part_of','food',[['label'=>'food','id'=>1],['label'=>'nonfood','id'=>2]]],
            ['Staff','person','Bar',[['label'=>'Barney Gumble','id'=>32],['label'=>'Bart Simpson','id'=>37]]],
            ['Staff','job','dir',[['label'=>'director','id'=>2]]],
        ];    
    }
    
    public function testAjaxCollections()
    {
        $response = $this->getJson('/ajax/collections?search=Ev');
        $response->assertStatus(200)
        ->assertJson([
            ['label'=>'Event','id'=>'Event'],
            ['label'=>'EventType','id'=>'EventType'],
        ]);
    }
    
    public static function AjaxCollectionsProvider()
    {
        return [
            ['Anniversary','Li',[['label'=>"Lisa's birthday",'id'=>3]]],
            ['EventType','ch',[['label'=>'change','id'=>2]]],
            ['Genre','ho',[['label'=>'horror','id'=>5]]],
            ['Network','Ho',[['label'=>'Home','id'=>1]]],
        ];
    }

    public function testAjaxTags()
    {
        $response = $this->getJson('/ajax/tags?search=ar');
        $response
        ->assertStatus(200)
        ->assertJson([['label'=>'Family.Marge','id'=>3],['label'=>'Family.Bart','id'=>4]]);
    }
        
}