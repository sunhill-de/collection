<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class ClassEntryItem extends PreloadedObjectItem
{

    protected $class_info;
    
    public function __construct($classinfo)
    {
        parent::__construct();
        $this->class_info = $classinfo;
    }
    
    protected function loadItems(): array
    {
        $result = [];
        
        $result['name'] = (new DynamicItem())->defineValue($this->class_info->name)->type('string'); 
        $result['description'] = (new DynamicItem())->defineValue($this->class_info->description)->type('string');
        $result['class'] = (new DynamicItem())->defineValue($this->class_info->class)->type('string');
        if (property_exists($this->class_info,'parent')) {
            $result['parent'] = (new DynamicItem())->defineValue($this->class_info->parent)->type('string');
        }
        $result['table'] = (new DynamicItem())->defineValue($this->class_info->table)->type('string');
        
/*        $this->createResponseFromValue()->OK()->type('string')->unit('None')->semantic('Name')->readable()->writeable(false)->update('asap');
        $result[] = $this->createResponseFromValue($this->class_info->class)->OK()->type('string')->unit('None')->semantic('Name')->readable()->writeable(false)->update('asap');
        $result[] = $this->createResponseFromValue($this->class_info->description)->OK()->type('string')->unit('None')->semantic('Name')->readable()->writeable(false)->update('asap');
*/        
        return $result;
    }
    
}
