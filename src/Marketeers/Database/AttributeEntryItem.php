<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class AttributeEntryItem extends PreloadedObjectItem
{

    protected $attribute_info;
    
    public function __construct($attributeinfo)
    {
        parent::__construct();
        $this->attribute_info = $attributeinfo;
    }
    
    protected function loadItems(): array
    {
        $result = [];
        
        $result['name'] = (new DynamicItem())->defineValue($this->attribute_info->name)->type('string'); 
        $result['type'] = (new DynamicItem())->defineValue($this->attribute_info->type)->type('string');
        $result['id'] = (new DynamicItem())->defineValue($this->attribute_info->id)->type('int');
        $result['allowed_classes'] = (new DynamicItem())->defineValue($this->attribute_info->allowed_classes)->type('string');
        
        return $result;
    }
    
}
