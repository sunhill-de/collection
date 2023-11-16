<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class UnitEntryItem extends PreloadedObjectItem
{

    protected $unit_info;
    
    public function __construct($unitinfo)
    {
        parent::__construct();
        $this->unit_info = $unitinfo;
    }
    
    protected function loadItems(): array
    {
        $result = [];
        
        $result['name'] = (new DynamicItem())->defineValue($this->unit_info::getName())->type('string'); 
        $result['unit'] = (new DynamicItem())->defineValue($this->unit_info::getUnit())->type('string');
        
        return $result;
    }
    
}
