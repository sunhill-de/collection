<?php

namespace Sunhill\Collection\Response\Information\Clock;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class IndexResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::clock.index';
 
    protected function prepareResponse()
    {
       parent::prepareResponse();
    }
}