<?php

namespace Sunhill\Collection\Modules\Database;

use Sunhill\Visual\Modules\SunhillCrudModule;

class SunhillFeatureCollection extends SunhillCrudModule
{
    
    protected static $route_base = 'collection';
    
    protected static $controller = \Sunhill\Collection\Controllers\Database\CollectionController::class;
    
    protected function setupBasics()
    {
        $this->setName('Collection');
        $this->setDisplayName('Collection');
        $this->setDescription('Collection');
    }
                
}
