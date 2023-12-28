<?php

namespace Sunhill\Collection\Facades;

use Illuminate\Support\Facades\Facade;

class SunhillCache extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sunhillcachemanager';
    }
}
