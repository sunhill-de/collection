<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxSearchResponse;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\Collection\Marketeers\DataSource\WebDataSource;

class AjaxNews extends AjaxSearchResponse
{
    
    protected function assembleSearchResult(string $search)
    {
        $source = new WebDataSource();
        
        $date = new \DateTime();
        //        $source->setUrl('192.168.3.3:8888/items?updatedsince='.$date->sub(\DateInterval::createFromDateString('12 hours'))->format('Y-m-d H:i:s'));
        $source->setUrl('192.168.3.3:8888/items');
        
        return $source->getData();
    }
    
}