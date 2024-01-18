<?php

namespace Sunhill\Collection\Marketeers\Weather;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\SimpleArrayItem;
use Sunhill\Collection\Marketeers\DataSource\CacheDataSource;
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;

class OpenWeatherMapMarketeer extends OnDemandMarketeer
{
    
    protected function getCurrentWeather($owm)
    {
        $weather = $owm->getWeather('Bünde', 'metric', 'de');        
    
        $this->addEntry('current', new OpenWeatherMapItem($weather));
    }
    
    protected function getForecast($owm)
    {
        $forecast = $owm->getWeatherForecast('Bünde', 'metric', 'de', '', 5);
        $this->addEntry('sunrise', (new DynamicItem())->defineValue($forecast->sun->rise->format('H:i'))->type('datetime')->semantic('Name'));
        $this->addEntry('sunset',  (new DynamicItem())->defineValue($forecast->sun->set->format('H:I'))->type('datetime')->semantic('Name'));
        
        $this->addEntry('forecast', new OpenWeatherMapForecastMarketeer($forecast));
    }
    
    protected function initializeMarketeer()
    {
        $httpRequestFactory = new RequestFactory();
        $httpClient = GuzzleAdapter::createWithConfig([]);
        
        $owm = new OpenWeatherMap(env('OPENWEATHERMAP_APIKEY'), $httpClient, $httpRequestFactory);
        $this->getCurrentWeather($owm);
        $this->getForecast($owm);
        
    }
    
    
}
