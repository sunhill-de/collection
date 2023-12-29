<?php

namespace Sunhill\Collection\Marketeers\Basic;

use Sunhill\Collection\Facades\SunhillCache;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;

abstract class CacheReadingMarketeer extends OnDemandMarketeer
{
    
    protected static $cache_entry = '';
    
    protected function readEntry()
    {
        $entry = SunhillCache::getEntry(static::$cache_entry);
        
        return $entry;
    }
}