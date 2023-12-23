<?php

namespace Sunhill\Collection\Facades;

use Illuminate\Support\Facades\Facade;

class Cache extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cachemanager';
    }
}
