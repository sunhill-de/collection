<?php

namespace Sunhill\Collection\Marketeers\Weather;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class WeatherDataItem extends PreloadedObjectItem
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
        
        $result['temp']       = (new DynamicItem())->defineValue($this->data['temp'])->type('bool')->semantic('Temperature')->unit('Degreecelsius');
        $result['wind_speed'] = (new DynamicItem())->defineValue($this->data['wind_speed'])->type('float')->semantic('Speed')->unit('Kilometerperhour');
        $result['wind_dir']   = (new DynamicItem())->defineValue($this->data['wind_dir'])->type('int')->semantic('Direction')->unit('Degree');
        $result['wind_gusts'] = (new DynamicItem())->defineValue($this->data['wind_gusts'])->type('float')->semantic('Speed')->unit('Kilometerperhour');;
        $result['precip']     = (new DynamicItem())->defineValue($this->data['precip'])->type('float')->semantic('Height')->unit('Millimeter');
        $result['pressure']   = (new DynamicItem())->defineValue($this->data['pressure'])->type('int')->semantic('Pressure')->unit('Pascal');
        $result['symbol']     = (new DynamicItem())->defineValue($this->data['symbol'])->type('int')->semantic('Name');
        $result['uv']         = (new DynamicItem())->defineValue($this->data['uv'])->type('int')->semantic('Name');
        
        return $result;
    }
    
}
    