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
        $this->addAction('ListCollection')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\CollectionsController::class, 'listcollection'])
            ->setVisible(false)
            ->setRouteAddition('/{collection}/{page?}/{order?}')
            ->setAlias('collection.list');
    }
    
    
}
