<?php

namespace Sunhill\Collection\Response\Cameras;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\InfoMarket;

class ShowCameraResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::cameras.show';
 
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