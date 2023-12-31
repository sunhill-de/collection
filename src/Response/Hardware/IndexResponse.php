<?php

namespace Sunhill\Collection\Response\Hardware;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class IndexResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::hardware.index';
 
    protected function prepareResponse()
    {
       parent::prepareResponse();
    }
}