<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\RedirectResponse;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Objects;

class ExecEditObjectResponse extends ObjectResponseBase
{
    
    protected $target = '/';

    protected $id = 0;
   
    protected function getWorkingObject()
    {
        $object = Objects::load($this->id);        
        
        $this->clearLists($object);
        $this->target = route('objects.show',['id'=>$this->id]);
        
        return $object;       
    }
    
    protected function clearLists($object)
    {
        $fields = $this->getEditable($object);

        foreach ($fields as $field) {
          $name = $field->name;
          $property = $object->getProperty($name);  
          $fieldtype = $property->getType();
          if (($fieldtype == 'ArrayOfStrings') || ($fieldtype == 'ArrayOfObjects')) {
            $object->$name = null;
          }
          $object->tags = [];
//          $object->attributes = [];
        }  
    } 
    
    public function setID($id)
    {
        $this->id = $id;
        return $this;
    }
    
}  
    
