<?php

namespace Sunhill\Collection\Response\Database\Classes;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Response\SunhillUserException;

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
        try {
            $class = Classes::getNamespaceOfClass($this->class);
        } catch (\Sunhill\ORM\ORMException $e) {
            throw new SunhillUserException(__("The class ':classname' does not exist.",['classname'=>$this->class]));
        }
    }
}  
