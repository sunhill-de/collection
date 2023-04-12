<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

class FeatureClassesTest extends HtmlTestBase
{
    
    public function HTMLProvider()
    {
        return [
            ['/Database/Classes/List',200,'get','Address'],          // Default list classes
            ['/Database/Classes/List/2',200,'get','Network'],        // List classes with page
            ['/Database/Classes/Show/Person',200],   // Show class with existing name
            ['/Database/Classes/Show/1',200],        // Show class with existing index            
            
            ['/Database/Classes/Show/NonExistingClass',500],  // Show non existing class
            ['/Database/Classes/Show/1000',500],              // Show class with non existing index
            ['/Database/Classes/List/1000',500],              // List classes with non existing page
        ];    
    }
    
}