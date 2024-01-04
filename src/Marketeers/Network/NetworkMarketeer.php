<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\ORM\InfoMarket\Marketeer;
use Sunhill\Collection\Marketeers\Network\PingMarketeer;

class NetworkMarketeer extends Marketeer
{
   
    public function __construct()
    {
        parent::__construct();
        $this->setName('network');
        $this->addEntry('ping', PingMarketeer::class);
        $this->addEntry('mac_scan', MacScanMarketeer::class);
/*        $this->addEntry('current_clients', CurrentClientsItem::class);
        $this->addEntry('known_clients', KnownClientsItem::class);
        $this->addEntry('test', TestStatus::class); */
    }
}  
