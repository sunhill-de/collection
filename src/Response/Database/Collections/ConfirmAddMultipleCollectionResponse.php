<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Utils\ObjectList;
use Sunhill\Collection\Traits\GetProperties;
use Sunhill\Visual\Response\SunhillUserException;
use Sunhill\ORM\Facades\Classes;

class ConfirmAddMultipleObjectResponse extends SunhillBladeResponse
{

    use GetProperties;
    
    protected $template = 'collection::objects.addmultiple';
    
    protected $class = '';
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        if (!Classes::searchClass($this->class)) {
            throw new SunhillUserException(__("The class ':classname' does not exist.",['classname'=>$this->class]));            
        }
            
        $classnamespace = $this->getNamespace($this->class);
        if (!$classnamespace::getInfo('instantiable')) {
            throw new SunhillUserException(__("Tried to instantiate object of uninstantiable class: ':classname'.",['classname'=>$this->class]));
        }
        $class = new \StdClass();
        $class->name = $this->class;
        $class->namespace = $classnamespace;
        $class->fields = $this->getEditable($classnamespace);
        $class->tablename = $classnamespace::getInfo('table');
        $this->params['key'] = $this->class;
        $this->params['class'] = $class;
    }
    
    public function setClass(string $class)
    {
        $this->class = $class;
        return $this;
    }
}  
