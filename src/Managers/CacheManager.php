<?php

namespace Sunhill\Collection\Managers;

use Sunhill\Collection\Collections\Cache_Entry;
use Sunhill\ORM\Facades\Collections;

class CacheManager
{

    public function getCurrentResult($item)
    {
        return Cache_Entry::query()->where('item',$item)->first();
    }
    
}
