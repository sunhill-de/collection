<?php

namespace Sunhill\Collection\Modules\Database;

use Sunhill\Visual\Response\Database\Classes\ListClassesResponse;
use Sunhill\Visual\Modules\SunhillModuleBase;

class SunhillFeatureTags extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Tags');
        $this->setDisplayName('Tags');        
        $this->setDescription('Tags');
        $this->addIndex(\Sunhill\Collection\Controllers\Database\TagsController::class);
        $this->addAction('List')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\TagsController::class, 'list'])
            ->setVisible(true)
            ->setRouteAddition('/{page?}')
            ->setAlias('tags.list');
        $this->addAction('Add')
             ->addControllerAction([\Sunhill\Collection\Controllers\Database\TagsController::class, 'add'])
             ->setVisible(true)
             ->setAlias('tags.add');
        $this->addAction('ExecAdd')
             ->setMethod('post')
             ->addControllerAction([\Sunhill\Collection\Controllers\Database\TagsController::class, 'execadd'])
             ->setVisible(false)
             ->setAlias('tags.execadd');
        $this->addAction('Edit')
             ->addControllerAction([\Sunhill\Collection\Controllers\Database\TagsController::class, 'edit'])
             ->setRouteAddition('/{id}')
             ->setVisible(false)
             ->setAlias('tags.edit');
        $this->addAction('ExecEdit')
             ->setMethod('post')
             ->addControllerAction([\Sunhill\Collection\Controllers\Database\TagsController::class, 'execedit'])
             ->setRouteAddition('/{id}')
             ->setVisible(false)
             ->setAlias('tags.execedit');
        $this->addAction('Show')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\TagsController::class, 'show'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('tags.show');
        $this->addAction('Delete')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\TagsController::class, 'delete'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('tags.delete');
    }
    
    
}
