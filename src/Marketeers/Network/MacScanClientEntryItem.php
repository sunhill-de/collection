<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\SimpleArrayItem;

class MacScanClientEntryItem extends OnDemandMarketeer
{

    protected $client_info;
    
    public function __construct($client_info)
    {
        parent::__construct();
        $this->client_info = $client_info;
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

    protected function sortByAddressType()
    {
        $addr_types = [];
        foreach ($this->client_info->address as $address) {
            switch ($address->attributes()->addrtype) {
                case 'ipv4':
                    if (!isset($addr_types['ipv4'])) {
                        $addr_types['ipv4'] = [$address->attributes()->addr];
                    } else {
                        $addr_types['ipv4'][] = $address->attributes()->addr;
                    }
                    break;
                case 'ipv6':
                    if (!isset($addr_types['ipv6'])) {
                        $addr_types['ipv6'] = [$address->attributes()->addr];
                    } else {
                        $addr_types['ipv6'][] = $address->attributes()->addr;
                    }
                    break;
                case 'mac':
                    if (!isset($addr_types['mac'])) {
                        $addr_types['mac'] = [$address->attributes()->addr];
                    } else {
                        $addr_types['mac'][] = $address->attributes()->addr;
                    }
                    break;
                default:
                    if (!isset($addr_types['other'])) {
                        $addr_types['other'] = [$address->attributes()->addrtype.':'.$address->attributes()->addr];
                    } else {
                        $addr_types['other'][] = $address->attributes()->addrtype.':'.$address->attributes()->addr;
                    }
            }
        }
        return $addr_types;
    }
    
    protected function sortByManufacturer()
    {
        $result = [];
        foreach ($this->client_info->address as $address) {
            if (isset($address->attributes()->manufacturer)) {
                $result[] = $address->attributes()->manufacturer;
            }
        }
        return $result;
        
    }
    
    protected function initializeMarketeer()
    {
        $addr_types = $this->sortByAddressType();
        foreach ($addr_types as $type => $entries) {
            if (count($entries) == 1) {
                $this->addEntry($type, (new DynamicItem())->defineValue($entries[0])->type('string')->semantic('Name'));
            } else {
                $item = new SimpleArrayItem();
                foreach ($entries as $index => $ip4_entry) {
                    $item->addEntry($index, (new DynamicItem())->defineValue($ip4_entry)->type('string')->semantic('Name'));
                }
                $this->addEntry($type, $item);
            }
        }
    }
    
}
