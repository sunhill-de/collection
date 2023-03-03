<?php

namespace Sunhill\Collection\Facades;

use Illuminate\Support\Facades\Facade;

class Imports extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'importmanager';
    }
}
