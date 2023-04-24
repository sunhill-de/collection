<?php

namespace Sunhill\Collection\Facades;

use Illuminate\Support\Facades\Facade;

class TMDB extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tmdbmanager';
    }
}
