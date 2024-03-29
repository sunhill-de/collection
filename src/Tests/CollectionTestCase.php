<?php

namespace Sunhill\Collection\Tests;

use Sunhill\Basic\Tests\SunhillOrchestraTestCase;
use Sunhill\Basic\SunhillBasicServiceProvider;
use Sunhill\ORM\SunhillServiceProvider;
use Sunhill\Visual\VisualServiceProvider;
use Sunhill\Collection\CollectionServiceProvider;

class CollectionTestCase extends SunhillOrchestraTestCase
{
    
    protected function getPackageProviders($app)
    {
        return [
            SunhillBasicServiceProvider::class,
            SunhillServiceProvider::class,
            VisualServiceProvider::class,
            CollectionServiceProvider::class,            
        ];
    }
        
}