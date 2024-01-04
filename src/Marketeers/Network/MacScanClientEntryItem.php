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
            if (isset($address->attributes()->vendor)) {
                $result[] = $address->attributes()->vendor;
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
        foreach ($this->sortByManufacturer() as $manufacturer) {
            $this->addEntry('manufacturer', (new DynamicItem())->defineValue($manufacturer)->type('string')->semantic('Name'));
        }
    }
    
}
