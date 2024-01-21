<?php

namespace Sunhill\Collection\Response\Cameras;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class RotateFullscreenResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::cameras.rotate_fullscreen';
 
    protected function prepareResponse()
    {
       parent::prepareResponse();
    }
}