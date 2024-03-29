<?php

namespace Sunhill\Collection\Modules\Information;

use Sunhill\Visual\Modules\SunhillModuleBase;

class FeatureWeather extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Weather');        
        $this->setDisplayName('Weather');
        $this->setDescription('Show weather informations'); 
        $this->addIndex(\Sunhill\Collection\Controllers\Information\WeatherController::class);
    }
        
}
