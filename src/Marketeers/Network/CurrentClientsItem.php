<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class CurrentClientsItem extends OnDemandMarketeer
{

    protected function getCurrentClients()
    {
        $current_file = config('infomarket.data_dir').'/current';
        $data = json_decode(file_get_contents($current_file));
        if (($error = json_last_error_msg()) !== 'No error') {
            $this->addEntry('error',(new DynamicItem())->defineValue($error)->type('string')->semantic('Name'));
        }
        
        return $data;
    }
    
    protected function initializeMarketeer()
    {
        $clients = $this->getCurrentClients();
        $this->addEntry('count',(new DynamicItem())->defineValue(count($clients->clients))->type('int')->semantic('Count'));
        $this->addEntry('timestamp',(new DynamicItem())->defineValue($clients->timestamp)->type('int')->semantic('Count'));
        foreach ($clients->clients as $client) {
            $this->addEntry($client->MAC, new ClientEntryItem(file_get_contents(config('infomarket.data_dir').'/'.$client->MAC)));
        }
    }
            
}

