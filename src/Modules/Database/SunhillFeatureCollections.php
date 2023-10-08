<?php

namespace Sunhill\Collection\Modules\Database;

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
            ->setRouteAddition('/{page?}/{order?}')
            ->setAlias('collections.list');
        $this->addAction('Show')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'show'])
            ->setVisible(false)
            ->setRouteAddition('/{collection}')
            ->setAlias('collections.show');
        $this->addAction('Add')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'add'])
            ->setVisible(false)
            ->setRouteAddition('/{collection}')
            ->setAlias('collection.add');
        $this->addAction('ExecAdd')
            ->setMethod('post')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'execadd'])
            ->setVisible(false)
            ->setRouteAddition('/{collection}')
            ->setAlias('collection.execadd');
        $this->addAction('ListCollection')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'listcollection'])
            ->setVisible(false)
            ->setRouteAddition('/{collection}/{page?}/{order?}')
            ->setAlias('collection.list');
        $this->addAction('ShowCollection')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'showcollection'])
            ->setVisible(false)
            ->setRouteAddition('/{collection}/{id}')
            ->setAlias('collection.show');
        $this->addAction('EditCollection')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'editcollection'])
            ->setVisible(false)
            ->setRouteAddition('/{collection}/{id}')
            ->setAlias('collection.edit');
        $this->addAction('ExecEdit')
            ->setMethod('post')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'execedit<'])
            ->setVisible(false)
            ->setRouteAddition('/{collection}')
            ->setAlias('collection.execedit');
        $this->addAction('DeleteCollection')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'deletecollection'])
            ->setVisible(false)
            ->setRouteAddition('/{collection}/{id}')
            ->setAlias('collection.delete');
    }
    
    
}
