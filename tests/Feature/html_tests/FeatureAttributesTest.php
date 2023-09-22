<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

class FeatureAttributesTest extends HtmlTestBase
{
    
    public static function HTMLProvider()
    {
        return [
            ['/Database/Attributes/List',200],          // Default list classes
            
            ['/Database/Attributes/List/1000',500],              // List classes with non existing page
        ];    
    }
    
}