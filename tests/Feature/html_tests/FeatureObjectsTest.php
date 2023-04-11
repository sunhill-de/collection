<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

use Sunhill\Collection\Tests\CollectionTestCase;

use Sunhill\Visual\Facades\SunhillSiteManager;
use Sunhill\Collection\Modules\Database\SunhillFeatureClasses;
use Sunhill\Collection\Modules\Database\SunhillFeatureObjects;
use Sunhill\Collection\Modules\Database\SunhillFeatureTags;
use Sunhill\Collection\Modules\Database\SunhillFeatureAttributes;
use Sunhill\Collection\Modules\Database\SunhillFeatureImports;
use Sunhill\Collection\Tests\DatabaseTestCase;

class FeatureObjectsTest extends HtmlTestBase
{
    
 
    public function HTMLProvider()
    {
        return [
            ['/Database/Objects/List',200],
            ['/Database/Objects/Show/1',200],
            ['/Database/Objects/Add/Country',200],
            
            ['/Database/Objects/Show/10000',500],
            ['/Database/Objects/Add/Object',500],
            ['/Database/Objects/Add/NonExistingClass',500],
        ];
    }
    
}