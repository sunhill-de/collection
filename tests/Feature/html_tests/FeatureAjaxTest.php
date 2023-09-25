<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

class FeatureAjaxTest extends HtmlTestBase
{
    
    public static function HTMLProvider()
    {
        return [
            ['/ajax/searchTags?search=Fa',200],       // Search Tags
        ];    
    }
    
}