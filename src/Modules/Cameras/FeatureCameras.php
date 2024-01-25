<?php

namespace Sunhill\Collection\Modules\Cameras;

use Sunhill\Visual\Modules\SunhillModuleBase;
use Sunhill\Collection\Controllers\Camera\RotateController;

class FeatureCameras extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Cameras');        
        $this->setDisplayName('Cameras');
        $this->setDescription('Feature for handling cameras');         
        $this->addIndex(\Sunhill\Collection\Controllers\Camera\CamerasController::class)
             ->setAlias('cameras.index');
        $this->addAction('Rotate')
             ->addControllerAction(\Sunhill\Collection\Controllers\Camera\CamerasController::class, 'rotate')
             ->setAlias('cameras.rotate')
             ->setVisible(true);
        $this->addAction('RotateFullscreen')
             ->addControllerAction([\Sunhill\Collection\Controllers\Camera\CamerasController::class, 'rotateFullscreen'])
             ->setVisible(false)
             ->setAlias('cameras.rotate_fullscreen');
    }
        
}
