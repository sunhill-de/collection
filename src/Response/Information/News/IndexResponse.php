<?php

namespace Sunhill\Collection\Response\Information\News;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class IndexResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::news.index';
 
    protected function prepareResponse()
    {
       parent::prepareResponse();
    }
}