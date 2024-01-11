<?php

namespace Sunhill\Collection\Modules\Information;

use Sunhill\Visual\Modules\SunhillModuleBase;

class FeatureDates extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Calendar');        
        $this->setDisplayName('Calendar');
        $this->setDescription('Show calendar'); 
        $this->addIndex(\Sunhill\Collection\Controllers\Information\DatesController::class);
    }
        
}
