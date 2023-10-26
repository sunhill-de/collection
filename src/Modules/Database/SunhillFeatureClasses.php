<?php

namespace Sunhill\Collection\Modules\Database;

use Sunhill\Visual\Response\Database\Classes\ListClassesResponse;
use Sunhill\Visual\Modules\SunhillSemiCrudModule;

class SunhillFeatureClasses extends SunhillSemiCrudModule
{
    
    protected static $route_base = 'classes';
    
    protected static $controller = \Sunhill\Collection\Controllers\Database\ClassesController::class;
    
    protected function setupBasics()
    {
        $this->setName('Classes');
        $this->setDisplayName('Classes');        
        $this->setDescription('Classes');
    }
        
    protected function setupAdditional()
    {
        $this->addAction('Choose')
            ->addControllerAction([static::$controller, 'choose'])
            ->setVisible(false)
            ->setAlias(static::$route_base.'.choose');        
        $this->addAction('Select')
            ->addControllerAction([static::$controller, 'select'])
            ->setVisible(false)
            ->setAlias(static::$route_base.'.select');
    }
}
