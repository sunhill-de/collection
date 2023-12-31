<?php

namespace Sunhill\Collection\Modules\Network;

use Sunhill\Visual\Modules\SunhillModuleBase;

class FeatureNetwork extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Network');        
        $this->setDisplayName('Network');
        $this->setDescription('Informations about the network'); 
        $this->addIndex(\Sunhill\Collection\Controllers\Network\NetworkController::class);
    }
        
}
