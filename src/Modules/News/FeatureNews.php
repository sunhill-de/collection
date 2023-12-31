<?php

namespace Sunhill\Collection\Modules\News;

use Sunhill\Visual\Modules\SunhillModuleBase;

class FeatureNews extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('News');        
        $this->setDisplayName('News');
        $this->setDescription('Show news'); 
        $this->addIndex(\Sunhill\Collection\Controllers\News\NewsController::class);
    }
        
}
