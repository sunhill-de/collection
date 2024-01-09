<?php

namespace Sunhill\Collection\Marketeers\News;

use Sunhill\ORM\InfoMarket\Items\PreloadedObjectItem;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class NewsHeadline extends PreloadedObjectItem
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
         
        $result['id']       = (new DynamicItem())->defineValue($this->data->id)->type('int')->semantic('Name');
        $result['stamp']    = (new DynamicItem())->defineValue($this->data->datetime)->type('datetime')->semantic('Name');
        $result['title']    = (new DynamicItem())->defineValue($this->data->title)->type('string')->semantic('Name');
        
        return $result;
    }
    
}
    