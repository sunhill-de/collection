<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class SemanticEntryItem extends PreloadedObjectItem
{

    protected $semantic_info;
    
    public function __construct($semanticinfo)
    {
        parent::__construct();
        $this->semantic_info = $semanticinfo;
    }
    
    protected function loadItems(): array
    {
        $result = [];
        
        $result['name'] = (new DynamicItem())->defineValue($this->semantic_info::getName())->type('string'); 
        $result['unit'] = (new DynamicItem())->defineValue($this->semantic_info::getUnit())->type('string');
        
        return $result;
    }
    
}
