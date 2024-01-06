<?php

namespace Sunhill\Collection\Modules\Information;

use Sunhill\Visual\Modules\SunhillModuleBase;

class FeatureDates extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Dates');        
        $this->setDisplayName('Dates');
        $this->setDescription('Show dates'); 
        $this->addIndex(\Sunhill\Collection\Controllers\Information\DatesController::class);
    }
        
}
