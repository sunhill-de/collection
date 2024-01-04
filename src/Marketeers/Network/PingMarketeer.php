<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\ORM\InfoMarket\OnDemandMarketeer;

class PingMarketeer extends OnDemandMarketeer
{
   
        protected function initializeMarketeer()
        {
            $this->addEntry('internet', new PingItem('ping.internet'));
            $this->addEntry('internet_via_wifi', new PingItem('ping.internet_wifi'));

            $this->addEntry('gateway', new PingItem('ping.gateway'));
            $this->addEntry('gateway_via_wifi', new PingItem('ping.gateway_wifi'));

            $this->addEntry('router', new PingItem('ping.router'));
            $this->addEntry('jack', new PingItem('ping.jack'));
            $this->addEntry('hugo', new PingItem('ping.hugo'));
            $this->addEntry('ben', new PingItem('ping.ben'));
            $this->addEntry('kate', new PingItem('ping.kate'));
            $this->addEntry('sayid', new PingItem('ping.sayid'));            
        }
        
}  
