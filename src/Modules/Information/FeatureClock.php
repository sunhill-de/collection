<?php

namespace Sunhill\Collection\Modules\Information;

use Sunhill\Visual\Modules\SunhillModuleBase;

class FeatureClock extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Clock');        
        $this->setDisplayName('Clock');
        $this->setDescription('Show a clock'); 
        $this->addIndex(\Sunhill\Collection\Controllers\Information\ClockController::class);
    }
        
}
