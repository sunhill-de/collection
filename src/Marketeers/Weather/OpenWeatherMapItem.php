<?php

namespace Sunhill\Collection\Marketeers\Weather;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class OpenWeatherMapItem extends PreloadedObjectItem
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
        
 //       $result['clouds_text'] = (new DynamicItem())->defineValue($this->data->clouds->description)->type('string')->semantic('Name');
 //       $result['clouds_value'] = (new DynamicItem())->defineValue($this->data->clouds->value)->type('integer')->semantic('Name');
        $humidity = $this->data->humidity->getValue();
        
        $result['humidity'] = (new DynamicItem())->defineValue($this->data->humidity->getValue())->type('int')->semantic('Name')->unit('Percent');
        $result['precipitation'] = (new DynamicItem())->defineValue($this->data->precipitation->getValue())->type('int')->semantic('Height')->unit('Millimeter');
        $result['pressure'] = (new DynamicItem())->defineValue($this->data->pressure->getValue())->type('int')->semantic('Pressure')->unit('Pascal');
        $result['temperature'] = (new DynamicItem())->defineValue($this->data->temperature->now->getValue())->type('float')->semantic('Temperature')->unit('Degreecelsius');
        
        $result['condition_text'] = (new DynamicItem())->defineValue($this->data->weather->description)->type('string')->semantic('Name');
       
        $result['condition_icon'] = (new DynamicItem())->defineValue($this->data->weather->getIconUrl())->type('string')->semantic('Name');
        
        $result['wind_speed'] = (new DynamicItem())->defineValue($this->data->wind->speed->getValue())->type('float')->semantic('Speed')->unit('Meterpersecond');
        $result['wind_description'] = (new DynamicItem())->defineValue($this->data->wind->speed->getDescription())->type('string')->semantic('Name');
        $result['winddir_description'] = (new DynamicItem())->defineValue($this->data->wind->direction->getDescription())->type('string')->semantic('Name');
        $result['winddir_name'] = (new DynamicItem())->defineValue($this->data->wind->direction->getUnit())->type('string')->semantic('Name');
        $result['winddir'] = (new DynamicItem())->defineValue($this->data->wind->direction->getValue())->type('int')->semantic('Direction')->unit('Degree');
        
        return $result;
    }
    
}
    