<?php

namespace Sunhill\Collection\Modules\Hardware;

use Sunhill\Visual\Modules\SunhillModuleBase;

class FeatureHardware extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Hardware');        
        $this->setDisplayName('Hardware');
        $this->setDescription('Informations about hardware'); 
        $this->addIndex(\Sunhill\Collection\Controllers\Hardware\HardwareController::class);
    }
        
}
