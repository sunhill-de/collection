<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\ORM\InfoMarket\Marketeer;

class NetworkMarketeer extends Marketeer
{
   
    public function __construct()
    {
        parent::__construct();
        $this->setName('network');
        $this->addEntry('current_clients', CurrentClientsItem::class);
        $this->addEntry('known_clients', KnownClientsItem::class);
    }
}  
