<?php

namespace Sunhill\Collection\Response\Database\Classes;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\Classes;

class SelectClassesResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::classes.select';
    
    protected $action = '';
    
    public function setAction(string $action)
    {
        $this->action = $action;
        return $this;
    }
    
    public function prepareResponse()
    {
        parent::prepareResponse();
    }
}  
