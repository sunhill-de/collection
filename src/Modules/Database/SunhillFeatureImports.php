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
        $this->addAction('ImportFile')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ImportFile'])
            ->setVisible(true)
            ->setAlias('imports.file');
        $this->addAction('ExecImportFile')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ExecImportFile'])
            ->setVisible(false)
            ->setMethod('post')
            ->setAlias('imports.execfile');
        $this->addAction('Movies')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ListMovies'])
            ->setVisible(true)
            ->setRouteAddition('/{page?}')
            ->setAlias('imports.movies.list');
        $this->addAction('ShowMovie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ShowMovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('imports.movies.show');
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
