<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

class FeatureAjaxTest extends HtmlTestBase
{
    
    public static function HTMLProvider()
    {
        return [
            ['/ajax/tags?search=Fa',200],       // Search Tags
        ];    
    }
    
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
    
}