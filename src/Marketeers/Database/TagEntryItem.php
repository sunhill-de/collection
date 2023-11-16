<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class TagEntryItem extends PreloadedObjectItem
{

    protected $tag_info;
    
    public function __construct($taginfo)
    {
        parent::__construct();
        $this->tag_info = $taginfo;
    }
    
    protected function loadItems(): array
    {
        $result = [];
        
        $result['name'] = (new DynamicItem())->defineValue($this->tag_info->name)->type('string'); 
        $result['fullpath'] = (new DynamicItem())->defineValue($this->tag_info->fullpath)->type('string');
        $result['id'] = (new DynamicItem())->defineValue($this->tag_info->id)->type('int');
        
/*        $this->createResponseFromValue()->OK()->type('string')->unit('None')->semantic('Name')->readable()->writeable(false)->update('asap');
        $result[] = $this->createResponseFromValue($this->class_info->class)->OK()->type('string')->unit('None')->semantic('Name')->readable()->writeable(false)->update('asap');
        $result[] = $this->createResponseFromValue($this->class_info->description)->OK()->type('string')->unit('None')->semantic('Name')->readable()->writeable(false)->update('asap');
*/        
        return $result;
    }
    
}
