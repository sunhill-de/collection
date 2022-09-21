<?php

namespace Sunhill\Visual\Facades;

use Illuminate\Support\Facades\Facade;

class SiteManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sitemanager';
    }
}
