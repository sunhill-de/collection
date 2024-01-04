<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\Collection\Marketeers\DataSource\CacheDataSource;

class MacScanSubnetItem extends OnDemandMarketeer
{

    protected $cache_id;
    
    public function __construct(string $cache_id)
    {
        parent::__construct();
        $this->cache_id = $cache_id;
    }
    
    protected function getCurrentClients()
    {
        $data_source = new CacheDataSource();
        $data_source->setCacheName($this->cache_id);
        return simplexml_load_string($data_source->getData(), "SimpleXMLElement", LIBXML_NOCDATA);
    }

    protected function getMAC($client)
    {
        foreach ($client->address as $address) {
            if ($address->attributes()->addrtype=='mac') {
                return $address->attributes()->addr;
            }
        }
        return 'nomac';
    }
    
    protected function initializeMarketeer()
    {
        $clients = $this->getCurrentClients();
        $this->addEntry('count',(new DynamicItem())->defineValue(count($clients->host))->type('int')->semantic('Count'));
        $this->addEntry('timestamp',(new DynamicItem())->defineValue($clients->attributes()->start)->type('int')->semantic('Count'));
        foreach ($clients->host as $client) {
            $this->addEntry($this->getMAC($client), new MacScanClientEntryItem($client));
        }
    }
            
}

