<?php

namespace Sunhill\Collection\Modules\Database;

use Sunhill\Visual\Response\Database\Classes\ListClassesResponse;
use Sunhill\Visual\Modules\SunhillModuleBase;

class SunhillFeatureClasses extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Classes');
        $this->setDisplayName('Classes');        
        $this->setDescription('Classes');
        $this->addIndex(\Sunhill\Collection\Controllers\Database\ClassesController::class);
        $this->addAction('List')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ClassesController::class, 'list'])
            ->setVisible(true)
            ->setRouteAddition('/{page?}')
            ->setAlias('classes.list');
        $this->addAction('Show')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ClassesController::class, 'show'])
            ->setVisible(false)
            ->setRouteAddition('/{class}')
            ->setAlias('classes.show');
    }
    
    
}
