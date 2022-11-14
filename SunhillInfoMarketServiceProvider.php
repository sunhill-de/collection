<?php
/**
 * @file SunhillInfoMarketServiceProvider.php
 * The ServiceProvider for the InfoMarket
 * Lang en
 * Reviewstatus: 2021-10-26
 * Localization: none
 * Documentation: incomplete
 * Tests: none
 * Coverage: unknown
 * Dependencies: 
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket;

use Illuminate\Support\ServiceProvider;
use Sunhill\InfoMarket\Market\Market;
use Sunhill\InfoMarket\Facades\InfoMarket;

class SunhillInfoMarketServiceProvider extends ServiceProvider
{
    public function register()
    {        
        $this->app->singleton(Market::class, function () { return new Market(); } );
        $this->app->alias(Market::class,'infomarket');
    }
    
    public function boot()
    {
        $this->loadJSONTranslationsFrom(__DIR__.'/../resources/lang');
        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');
        InfoMarket::setupMarketeers();
    }
}
