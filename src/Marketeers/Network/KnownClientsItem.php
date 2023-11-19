<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class KnownClientsItem extends OnDemandMarketeer
{

    protected function getKnownClients()
    {
        $result = [];
        
        $dir = dir(config('infomarket.data_dir'));
        while (false !== ($entry = $dir->read())) 
        {
            if (!filter_var($entry, FILTER_VALIDATE_MAC)) 
            {
                continue;
            }
            
            $filename = config('infomarket.data_dir').'/'.$entry;
            $result[$entry] = new ClientEntryItem(file_get_contents($filename));
        }
        $dir->close();
        
        return $result;
    }
    
    protected function initializeMarketeer()
    {
        $clients = $this->getKnownClients();
        $this->addEntry('count',(new DynamicItem())->defineValue(count($clients))->type('int')->semantic('Count'));
        foreach ($clients as $mac => $client) {
            $this->addEntry($mac, $client);
        }
    }
            
}

