<?php

namespace Sunhill\Collection\Response\Information\Dates;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class IndexResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::dates.index';
 
    protected function prepareResponse()
    {
       parent::prepareResponse();
    }
}