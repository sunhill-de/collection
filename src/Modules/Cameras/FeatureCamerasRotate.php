<?php

namespace Sunhill\Collection\Modules\Cameras;

use Sunhill\Visual\Modules\SunhillModuleBase;
use Sunhill\Collection\Controllers\Camera\RotateController;

class FeatureCamerasRotate extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Rotate');        
        $this->setDisplayName('Rotate cameras');
        $this->setDescription('Slidshow of the camera images'); 
        $this->addIndex(\Sunhill\Collection\Controllers\Camera\RotateController::class)
        ->setAlias('cameras.rotate');
        $this->addAction('RotateFullscreen')
        ->addControllerAction([\Sunhill\Collection\Controllers\Camera\RotateController::class, 'rotateFullscreen'])
        ->setVisible(false)
        ->setAlias('cameras.rotate_fullscreen');
    }
        
}
