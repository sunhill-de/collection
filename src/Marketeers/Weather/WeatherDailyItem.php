<?php

namespace Sunhill\Collection\Marketeers\Weather;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class WeatherDailyItem extends PreloadedObjectItem
{
    
    protected $data;
    
    public function __construct($data)
    {
        parent::__construct();
        $this->data = $data;
    }
    
    protected function loadItems(): array
    {
        $result = [];
        $sunset = new \DateTime($this->data->sunset);
        $sunrise = new \DateTime($this->data->sunrise);
        
        $result['precip_24']     = (new DynamicItem())->defineValue($this->data->precip_24)->type('float')->semantic('Height')->unit('Millimeter');
        $result['symbol_24']     = (new DynamicItem())->defineValue($this->data->symbol_24)->type('int')->semantic('Name');
        $result['temp_max_24']   = (new DynamicItem())->defineValue($this->data->temp_max_24)->type('float')->semantic('Temperature')->unit('Degreecelsius');
        $result['temp_min_24']   = (new DynamicItem())->defineValue($this->data->temp_min_24)->type('float')->semantic('Temperature')->unit('Degreecelsius');;
        $result['wind_gusts_24'] = (new DynamicItem())->defineValue($this->data->wind_gusts_24)->type('float')->semantic('Speed')->unit('Kilometerperhour');
        $result['sunrise']       = (new DynamicItem())->defineValue($sunrise->format('H:i:s'))->type('datetime')->semantic('Name');
        $result['sunset']        = (new DynamicItem())->defineValue($sunset->format('H:i:s'))->type('datetime')->semantic('Name');
        
        return $result;
    }
    
}
    