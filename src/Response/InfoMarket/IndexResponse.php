<?php

namespace Sunhill\Collection\Response\InfoMarket;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\InfoMarket\Facades\InfoMarket;

class IndexResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::infomarket.index';
 
    protected function prepareResponse()
    {
       parent::prepareResponse();
       $this->params['entries'] = InfoMarket::getOffer(false); 
    }
}