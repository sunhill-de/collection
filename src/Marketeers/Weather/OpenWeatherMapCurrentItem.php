<?php

namespace Sunhill\Collection\Marketeers\Weather;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class OpenWeatherMapCurrentItem extends PreloadedObjectItem
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
        
        
        return $result;
    }
    
}
    