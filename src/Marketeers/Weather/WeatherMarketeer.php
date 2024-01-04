<?php

namespace Sunhill\Collection\Marketeers\Weather;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;
use Sunhill\ORM\InfoMarket\OnDemandMarketeer;
use Sunhill\ORM\InfoMarket\Items\SimpleArrayItem;
use Sunhill\Collection\Marketeers\DataSource\CacheDataSource;

class WeatherMarketeer extends OnDemandMarketeer
{
    

    public function getDailyData($raw_data)
    {
        $result = new \StdClass();
        
        $data = json_decode($raw_data);
        foreach ($data->data as $entry) {
            switch ($entry->parameter) {
                case "wind_gusts_10m_24h:kmh":
                    $result->wind_gusts_24 = $entry->coordinates[0]->dates[0]->value;
                    break;
                case "t_max_2m_24h:C":    
                    $result->temp_max_24 = $entry->coordinates[0]->dates[0]->value;
                    break;
                case "t_min_2m_24h:C":
                    $result->temp_min_24 = $entry->coordinates[0]->dates[0]->value;
                    break;
                case "precip_24h:mm":
                    $result->precip_24 = $entry->coordinates[0]->dates[0]->value;
                    break;
                case "weather_symbol_24h:idx":    
                    $result->symbol_24 = $entry->coordinates[0]->dates[0]->value;
                    break;
                case "sunrise:sql":
                    $result->sunrise = $entry->coordinates[0]->dates[0]->value;
                    break;
                case "sunset:sql":
                    $result->sunset = $entry->coordinates[0]->dates[0]->value;
                    break;
            }
              
        }
        
        return $result;
    }
    
    public function getMinutelyData($raw_data)
    {
        $result = new \StdClass();
        
        $time_slots = ['now','1hour','12hour','24hour','48hour'];
        
        $data = json_decode($raw_data);
        foreach ($data->data as $entry) {
            switch ($entry->parameter) {
                case "wind_speed_10m:kmh":
                    for ($i=0;$i<5;$i++) {
                        $name = 'wind_speed_'.$time_slots[$i];
                        $result->$name = $entry->coordinates[0]->dates[$i]->value;
                    }
                    break;
                case "wind_dir_10m:d":
                    for ($i=0;$i<5;$i++) {
                        $name = 'wind_dir_'.$time_slots[$i];
                        $result->$name = $entry->coordinates[0]->dates[$i]->value;
                    }
                    break;
                case "wind_gusts_10m_1h:ms":
                    for ($i=0;$i<5;$i++) {
                        $name = 'wind_gusts_'.$time_slots[$i];
                        $result->$name = $entry->coordinates[0]->dates[$i]->value;
                    }
                    break;
                case "t_2m:C":
                    for ($i=0;$i<5;$i++) {
                        $name = 'temp_'.$time_slots[$i];
                        $result->$name = $entry->coordinates[0]->dates[$i]->value;
                    }
                    break;
                case "msl_pressure:hPa":
                    for ($i=0;$i<5;$i++) {
                        $name = 'pressure_'.$time_slots[$i];
                        $result->$name = $entry->coordinates[0]->dates[$i]->value;
                    }
                    break;
                case "precip_1h:mm":
                    for ($i=0;$i<5;$i++) {
                        $name = 'precip_'.$time_slots[$i];
                        $result->$name = $entry->coordinates[0]->dates[$i]->value;
                    }
                    break;
                case "weather_symbol_1h:idx":
                    for ($i=0;$i<5;$i++) {
                        $name = 'symbol_'.$time_slots[$i];
                        $result->$name = $entry->coordinates[0]->dates[$i]->value;
                    }
                    break;
                case "uv:idx":
                    for ($i=0;$i<5;$i++) {
                        $name = 'uv_'.$time_slots[$i];
                        $result->$name = $entry->coordinates[0]->dates[$i]->value;
                    }
                    break;
            }
            
        }
        
        return $result;
        
    }
    
    protected function initializeMarketeer()
    {
        $source = new CacheDataSource();
        
        $source->setCacheName('weather.daily');
        $daily_data = $this->getDailyData($source->getData());  
        $this->addEntry('daily', new WeatherDailyItem($daily_data));
        
        $source->setCacheName('weather.minutely');
        $minutely_data = $this->getMinutelyData($source->getData());
        
        $time_slots = ['now','1hour','12hour','24hour','48hour'];
        $data_items = ['wind_speed','precip','pressure','symbol','temp','uv','wind_dir','wind_gusts'];

        foreach ($time_slots as $slot) {
            $data = [];
            foreach ($data_items as $item) {
                $varname = $item.'_'.$slot;
                $data[$item] = $minutely_data->$varname;
            }
            $this->addEntry($slot, new WeatherDataItem($data));
            
        }
    }
    
    
}
