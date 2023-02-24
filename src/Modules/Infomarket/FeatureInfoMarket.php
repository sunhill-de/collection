<?php

namespace Sunhill\Collection\Modules\Infomarket;

use Sunhill\Visual\Modules\SunhillModuleBase;

class FeatureInfoMarket extends SunhillModuleBase
{
    
    protected function setupModule()
    {
        $this->setName('Infomarket');        // Name der Hauptseite
        $this->setDisplayName('Infomarket');
        $this->setDescription('Anzeigen und Verwalten des Infomarktes'); // Beschreibung
        $this->addIndex(\Sunhill\Collection\Controllers\Infomarket\InfomarketController::class);
    }
        
}
