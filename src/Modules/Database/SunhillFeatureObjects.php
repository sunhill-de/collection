<?php

namespace Sunhill\Collection\Modules\Database;

use Sunhill\Visual\Modules\SunhillCrudModule;

class SunhillFeatureObjects extends SunhillCrudModule
{
    
    protected static $route_base = 'objects';
    
    protected static $prefix = '/{class?}';
    
    protected static $controller = \Sunhill\Collection\Controllers\Database\ObjectsController::class;
    
    protected function setupBasics()
    {
        $this->setName('Objects');
        $this->setDisplayName('Objects');
        $this->setDescription('Objects');
    }        
    
}
