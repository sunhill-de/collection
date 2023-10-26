<?php

namespace Sunhill\Collection\Modules\Database;

use Sunhill\Visual\Modules\SunhillCrudModule;

class SunhillFeatureAttributes extends SunhillCrudModule
{
    
    protected static $route_base = 'attributes';
    
    protected static $controller = \Sunhill\Collection\Controllers\Database\AttributesController::class;
    
    protected function setupBasics()
    {
        $this->setName('Attributes');
        $this->setDisplayName('Attributes');
        $this->setDescription('Attributes');
    }
    
    protected function setupAdditional()
    {
        $this->addAction('ListObjects')
             ->addControllerAction([static::$controller, 'listAssociatedObjects'])
             ->setVisible(false)
             ->setRouteAddition('/{id}/{page?}')
             ->setAlias('attributes.listobjects');
    }
    
}
