<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\SimpleArrayItem;
use Sunhill\Collection\Marketeers\DataSource\CacheDataSource;

class PingItem extends PreloadedObjectItem
{
    
    protected $cache_id;
    
    public function __construct(string $cache_id)
    {
        parent::__construct();
        $this->cache_id = $cache_id;
    }
    
    protected function getDataSource()
    {
        $source = new CacheDataSource();
        $source->setCacheName($this->cache_id);
        return $source;
    }
    
    public function getRawData()
    {
        $source = $this->getDataSource();
        return $source->getData();
    }
    
    public function getPingData($raw_data)
    {
        $result = new \StdClass();
        
        if (preg_match('/\((.*)\)/U', $raw_data, $match)) {
            $result->ip = $match[1];
        }
        if (preg_match('/icmp_seq=1 ttl=([0-9]+) time=([0-9\.]+)/', $raw_data, $match)) {
            $result->status = 1;
            $result->ttl = $match[1];
            $result->response = $match[2];
        } else {
            $result->status = 0;
            if (preg_match('/icmp_seq=1 (.*)/', $raw_data, $match)) {
                $result->message = $match[1];
            } else {
                $result->message = 'unreachable';
            }
        }
                    
        return $result;
    }
    
    protected function loadItems(): array
    {
        $result = [];
        
        $ping_data = $this->getPingData($this->getRawData());
        $result['ip'] = (new DynamicItem())->defineValue($ping_data->ip)->type('bool')->semantic('Name');
        if (($result['status'] = (new DynamicItem())->defineValue($ping_data->status)->type('bool')->semantic('Status'))) {
            $result['response'] = (new DynamicItem())->defineValue($ping_data->response)->type('float')->semantic('Duration');
            $result['ttl'] = (new DynamicItem())->defineValue($ping_data->ttl)->type('int')->semantic('Count');
        } else {
            $result['message'] = (new DynamicItem())->defineValue($ping_data->message)->type('string')->semantic('Name');
        }
        
        return $result;
    }
    
    
}
