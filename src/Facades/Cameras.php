<?php

namespace Sunhill\Collection\Facades;

use Illuminate\Support\Facades\Facade;

class Cameras extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'camerasmanager';
    }
}
