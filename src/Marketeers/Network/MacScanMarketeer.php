<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\ORM\InfoMarket\OnDemandMarketeer;

class MacScanMarketeer extends OnDemandMarketeer
{
   
        protected function initializeMarketeer()
        {
            $this->addEntry('int', new MacScanSubnetItem('macscan.int'));
            $this->addEntry('dmz', new MacScanSubnetItem('macscan.ext'));
            $this->addEntry('ext', new MacScanSubnetItem('macscan.dmz'));
        }
        
}  
