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
        
        $entry = explode("\n",$raw_data);
        $result->status = explode(' ',trim(explode(",",$entry[4])[1]))[0];
        if (preg_match('/\((.*)\)/U', $entry[0], $match)) {
            $result->ip = $match[1];
        }
        
        $answer = explode('icmp_seq=1 ',$entry[1]);
        if ($result->status == 1) {
            list($ttl_part, $time_part) = explode(' ',trim($answer[1]));
            $result->response = explode('=',$time_part)[1];
            $result->ttl = explode('=',$ttl_part)[1];
            
        } else {
            $result->message = $answer[1];
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
