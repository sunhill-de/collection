<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

use Sunhill\Collection\Tests\DatabaseTestCase;

class FeatureAjaxTest extends DatabaseTestCase
{
    
    public function testAjaxTags()
    {
        $response = $this->getJson('/ajax/tags?search=ar');
        $response
        ->assertStatus(200)
        ->assertJson([['label'=>'Family.Marge','id'=>3],['label'=>'Family.Bart','id'=>4]]);
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
     * @dataProvider AjaxCollectionsProvider
     */
    public function testAjaxCollections($collection, $search, $json)
    {
        $response = $this->getJson('/ajax/collections/'.$collection.'?search='.$search);
        $response->assertStatus(200)
                 ->assertJson($json);
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
}