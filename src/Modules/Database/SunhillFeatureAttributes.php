<?php

namespace Sunhill\Collection\Modules\Database;

use Sunhill\Visual\Response\Database\Classes\ListClassesResponse;
use Sunhill\Visual\Modules\SunhillModuleBase;

class SunhillFeatureAttributes extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Attributes');
        $this->setDisplayName('Attributes');        
        $this->setDescription('Attributes');
        $this->addIndex(\Sunhill\Collection\Controllers\Database\AttributesController::class);

        $this->addAction('List')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\AttributesController::class, 'list'])
            ->setVisible(true)
            ->setRouteAddition('/{page?}')
            ->setAlias('attributes.list');
        $this->addAction('Add')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\AttributesController::class, 'add'])
            ->setVisible(true)
            ->setAlias('attributes.add');
        $this->addAction('ExecAdd')
            ->setMethod('post')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\AttributesController::class, 'execadd'])
            ->setVisible(false)
            ->setAlias('attributes.execadd');
        $this->addAction('Edit')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\AttributesController::class, 'edit'])
            ->setRouteAddition('/{id}')
            ->setVisible(false)
            ->setAlias('attributes.edit');
        $this->addAction('ExecEdit')
            ->setMethod('post')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\AttributesController::class, 'execedit'])
            ->setRouteAddition('/{id}')
            ->setVisible(false)
            ->setAlias('attributes.execedit');
        $this->addAction('Show')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\AttributesController::class, 'show'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('attributes.show');
        $this->addAction('Delete')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\AttributesController::class, 'delete'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('attributes.delete');
        $this->addAction('ListChildren')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\AttributesController::class, 'listChildren'])
            ->setVisible(false)
            ->setRouteAddition('/{id}/{page?}')
            ->setAlias('attributes.listchildren');
        $this->addAction('ListObjects')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\AttributesController::class, 'listAssociatedObjects'])
            ->setVisible(false)
            ->setRouteAddition('/{id}/{page?}')
            ->setAlias('attributes.listobjects');
        
    }
    
    
}
