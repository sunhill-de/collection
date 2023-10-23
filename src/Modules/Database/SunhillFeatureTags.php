<?php

namespace Sunhill\Collection\Modules\Database;

use Sunhill\Visual\Modules\SunhillCrudModule;

class SunhillFeatureTags extends SunhillCrudModule
{
    
    protected static $route_base = 'tags';
    
    protected static $controller = \Sunhill\Collection\Controllers\Database\TagsController::class;
    
    protected function setupBasics()
    {
        $this->setName('Tags');
        $this->setDisplayName('Tags');
        $this->setDescription('Tags');
    }
    
    protected function setupAdditional()
    {
        $this->addAction('ListChildren')
             ->addControllerAction([static::$controller, 'listChildren'])
             ->setVisible(false)
             ->setRouteAddition('/{id}/{page?}')
             ->setAlias('tags.listchildren');
        $this->addAction('ListObjects')
             ->addControllerAction([static::$controller, 'listAssociatedObjects'])
             ->setVisible(false)
             ->setRouteAddition('/{id}/{page?}')
             ->setAlias('tags.listobjects');
    }
        
}
