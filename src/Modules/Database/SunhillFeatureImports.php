<?php

namespace Sunhill\Collection\Modules\Database;

use Sunhill\Visual\Response\Database\Classes\ListClassesResponse;
use Sunhill\Visual\Modules\SunhillModuleBase;

class SunhillFeatureImports extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Imports');
        $this->setDisplayName('Imports');        
        $this->setDescription('Imports');
        $this->addIndex(\Sunhill\Collection\Controllers\Database\ImportsController::class);
        $this->addAction('Movies')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ListMovies'])
            ->setVisible(true)
            ->setRouteAddition('/{page?}')
            ->setAlias('movies.list');
        $this->addAction('ShowMovie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ShowMovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('movies.show');
        $this->addAction('EditMovie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'EditMovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('movies.edit');
        $this->addAction('DeleteMovie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'DeleteMovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('movies.delete');
        $this->addAction('LookupMovie')
            ->setDisplayName('Lookup movie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'Lookupmovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('movies.lookup');
    }
    
    
}
