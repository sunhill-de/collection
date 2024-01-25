<?php

namespace Sunhill\Collection\Response\Cameras;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;
use Sunhill\Collection\Facades\Cameras;

class CamerasIndexResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::cameras.index';
 
    protected function prepareResponse()
    {
       parent::prepareResponse();
       $this->params['cameras'] = Cameras::getCameras('low');
    }
}