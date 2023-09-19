<?php

namespace Sunhill\Collection\Modules\Database;

use Sunhill\Visual\Response\Database\Classes\ListClassesResponse;
use Sunhill\Visual\Modules\SunhillModuleBase;

class SunhillFeatureCollections extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Collections');
        $this->setDisplayName('Collections');        
        $this->setDescription('Collections');
        $this->addIndex(\Sunhill\Collection\Controllers\Database\CollectionsController::class);
        $this->addAction('List')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'list'])
            ->setVisible(true)
            ->setRouteAddition('/{key?}/{page?}/{order?}')
            ->setAlias('objects.list');
        $this->addAction('Show')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'show'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('objects.show');
        $this->addAction('Add')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'add'])
            ->setVisible(true)
            ->setRouteAddition('/{class?}')
            ->setAlias('objects.add');
        $this->addAction('ExecAdd')
            ->setMethod('post')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'execadd'])
            ->setVisible(false)
            ->setAlias('objects.execadd');
        $this->addAction('Edit')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'edit'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('objects.edit');
        $this->addAction('ExecEdit')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'execedit'])
            ->setVisible(false)
            ->setMethod('post')
            ->setRouteAddition('/{id}')
            ->setAlias('objects.execedit');
        $this->addAction('Delete')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'delete'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('objects.delete');
    }
    
    
}
