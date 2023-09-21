<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

class FeatureCollectionsTest extends HtmlTestBase
{
    
    public static function HTMLProvider()
    {
        return [
            ['/Database/Collections/List',200,'get','Anniversary'],          // Default list classes
            ['/Database/Collections/Show/Anniversary',200],   // Show class with existing name
            
            ['/Database/Collections/Show/NonExistingClass',500],  // Show non existing class
            ['/Database/Collections/List/1000',500],              // List classes with non existing page
        ];    
    }
    
}