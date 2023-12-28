<?php

namespace Sunhill\Collection\Managers;

use Sunhill\Collection\Collections\Cache_Item;

class SunhillCacheManager
{
    
    public function getEntry(string $id)
    {
        $entry = Cache_Item::query()::where('item',$id)->first();
        return $entry;
    }
    
}
