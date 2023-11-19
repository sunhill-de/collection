<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\SimpleArrayItem;

class ClientEntryItem extends OnDemandMarketeer
{

    protected $client_info;
    
    public function __construct($client_info)
    {
        parent::__construct();
        try {
            $this->client_info = simplexml_load_string($client_info, "SimpleXMLElement", LIBXML_NOCDATA);
        } catch (\Exception $e) {
            $this->client_info = [];
        }
    }
    
    protected function addAddresses()
    {
        if (!isset($this->client_info->host->address)) {
            return;
        }
        $ip4 = [];
        foreach ($this->client_info->host->address as $address) {
            switch ($address->attributes()->addrtype) {
                case 'ipv4':
                    $ip4[] = $address->attributes()->addr;
                    break;
                case 'mac':
                    $this->addEntry('MAC address',(new DynamicItem())->defineValue($address->attributes()->addr)->type('string')->semantic('Name'));
                    $this->addEntry('Device manufacturet',(new DynamicItem())->defineValue($address->attributes()->vendor)->type('string')->semantic('Name'));
                    break;
            }
        }
        if (count($ip4) == 1) {
            $this->addEntry('IP Address',(new DynamicItem())->defineValue($ip4[0])->type('string')->semantic('Name'));
        } else if (count($ip4) > 1) {
            $item = new SimpleArrayItem();
            foreach ($ip4 as $index => $ip4_entry) {
                $item->addEntry($index, (new DynamicItem())->defineValue($ip4_entry)->type('string')->semantic('Name'));                
            }
        }
    }
    
    protected function initializeMarketeer()
    {
        $result = [];
        $this->addAddresses();
        return $result;
    }
    
}
