<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

class FeatureAttributesTest extends HtmlTestBase
{
    
    public static function HTMLProvider()
    {
        return [
            ['/Database/Attributes/List',200],       // List attributes
            ['/Database/Attributes/Add', 200],       // Add attribute
            ['/Database/Attributes/Edit/1', 200],    // Edit attribute
            
            ['/Database/Attributes/List/1000',500],  // List attributes with an invalid index
            ['/Database/Attributes/Edit/1000',500],  // Edit a nonexistant attribute
        ];    
    }
    
}