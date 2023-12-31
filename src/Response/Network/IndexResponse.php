<?php

namespace Sunhill\Collection\Response\Network;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class IndexResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::network.index';
 
    protected function prepareResponse()
    {
       parent::prepareResponse();
    }
}