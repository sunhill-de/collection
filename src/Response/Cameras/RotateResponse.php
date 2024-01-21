<?php

namespace Sunhill\Collection\Response\Cameras;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class RotateResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::cameras.rotate';
 
    protected function prepareResponse()
    {
       parent::prepareResponse();
    }
}