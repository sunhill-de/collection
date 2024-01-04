<?php

namespace Sunhill\Collection\Marketeers\DataSource;

use Sunhill\Collection\Collections\Cache_Entry;
use Sunhill\Collection\Collections\Cache_Item;
use Sunhill\Collection\Marketeers\DataSource\Exceptions\UnknownCacheItemException;

class CacheDataSource extends DataSourceBase
{
    
    protected $cache_name;
    
    public function setCacheName(string $name)
    {
        $this->cache_name = $name;    
    }
    
    public function getData()
    {
        if (!($item = Cache_Item::search()->where('name', $this->cache_name)->first())) {
            throw new UnknownCacheItemException("The item '".$this->cache_name."' is unknown.");
            return;
        }
        $cache = Cache_Entry::search()->where('item', $item->id)->first();
        return $cache->entry;
    }
}