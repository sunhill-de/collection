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

        $this->addAction('Movies/List')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ListMovies'])
            ->setVisible(true)
            ->setRouteAddition('/{page?}/{order?}/{filter?}')
            ->setAlias('imports.movies.list');
        $this->addAction('Series/Add')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'AddSeries'])
            ->setVisible(true)
            ->setAlias('imports.movies.add');
        $this->addAction('Series/ExecAdd')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ExecAddSeries'])
            ->setVisible(false)
            ->setMethod('post')
            ->setAlias('imports.movies.execadd');
        $this->addAction('ShowMovie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ShowMovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('imports.movies.show');
        $this->addAction('EditMovie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'EditMovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('imports.movies.edit');
        $this->addAction('ExecEditMovie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ExecEditMovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setMethod('post')
            ->setAlias('imports.movies.execedit');
        $this->addAction('DeleteMovie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'deleteMovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('imports.movies.delete');
        $this->addAction('LookupMovie')
            ->setDisplayName('Lookup movie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'Lookupmovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('imports.movies.lookup');
        $this->addAction('ExecLookupMovie')
            ->setDisplayName('Lookup movie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ExecLookupMovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setMethod('post')            
            ->setAlias('imports.movies.execlookup');            
        $this->addAction('ImportMovie')
            ->setDisplayName('Import movie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'Importmovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('imports.movies.import');
        $this->addAction('ExecImportMovie')
            ->setDisplayName('Import movie')
            ->addControllerAction([\Sunhill\Collection\Controllers\Database\ImportsController::class, 'ExecImportmovie'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setMethod('post')
            ->setAlias('imports.movies.execimport');
    }
    
    
}
