<?php

namespace Sunhill\Collection\Modules\Information;

use Sunhill\Visual\Modules\SunhillModuleBase;
use Sunhill\Collection\Controllers\Information\NewsController;

class FeatureNews extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('News');        
        $this->setDisplayName('News');
        $this->setDescription('Show news'); 
        $this->addIndex(\Sunhill\Collection\Controllers\Information\NewsController::class);
        $this->addAction('Show')
            ->addControllerAction([NewsController::class, 'show'])
            ->setVisible(false)
            ->setRouteAddition('/{id}')
            ->setAlias('news.show');
    }
        
}
