<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\ORM\Facades\Tags;
use Sunhill\Visual\Response\SunhillBladeResponse;

class ShowTagResponse extends SunhillBladeResponse
{

    protected $template = 'collection::tags.show';
        
    protected $id;
    
    public function setID(int $id)
    {
        $this->id = $id;
    }
    protected function prepareResponse()
    {
        parent::prepareResponse();
    }
    
}  
