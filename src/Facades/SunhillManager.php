<?php

namespace Sunhill\Collection\Facades;

use Illuminate\Support\Facades\Facade;

class SunhillManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sunhillmanager';
    }
}
