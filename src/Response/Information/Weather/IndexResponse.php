<?php

namespace Sunhill\Collection\Response\Information\Weather;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class IndexResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::weather.index';
 
    protected function prepareResponse()
    {
       parent::prepareResponse();
    }
}