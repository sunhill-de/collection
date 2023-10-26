<?php

namespace Sunhill\Collection\Modules\Database;

use Sunhill\Visual\Modules\SunhillSemiCrudModule;

class SunhillFeatureCollections extends SunhillSemiCrudModule
{
    
    protected static $route_base = 'collections';
    
    protected static $controller = \Sunhill\Collection\Controllers\Database\CollectionsController::class;
    
    protected function setupBasics()
    {
        $this->setName('Collections');
        $this->setDisplayName('Collections');
        $this->setDescription('Collections');
    }
        
}
