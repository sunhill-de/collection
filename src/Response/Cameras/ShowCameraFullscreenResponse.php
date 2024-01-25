<?php

namespace Sunhill\Collection\Response\Cameras;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class ShowCameraFullscreenResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::cameras.show_fullscreen';
 
    protected $id;
    
    public function setID(int $id)
    {
        $this->id = $id;
        return $this;
    }
    
    protected function prepareResponse()
    {
       parent::prepareResponse();
       $this->params['id'] = $this->id;
       $this->params['title'] = 'Kamera';
    }
}