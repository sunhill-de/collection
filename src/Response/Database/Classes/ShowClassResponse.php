<?php

namespace Sunhill\Collection\Response\Database\Classes;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Response\SunhillUserException;
use Sunhill\Collection\Facades\SunhillManager;

class ShowClassResponse extends SunhillBladeResponse
{
    
    protected $template = 'collection::classes.show';
    
    protected $class = '';
    
    public function setClass(string $class)
    {
        $this->class = $class;
        return $this;
    }
    
    public function prepareResponse()
    {
        parent::prepareResponse();
        $infos = SunhillManager::getClassInformations($this->class);
        $this->params = array_merge($this->params, $infos);
    }
}  
