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

        $source->setUrl(env('RSS_AGGREGATOR_SERVER'));
        
        return $source->getData();
    }
    
}