<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Sunhill\ORM\Facades\Objects;
use Sunhill\Collection\Utils\HasID;
use Sunhill\Visual\Response\SunhillUserException;

class ExecEditObjectResponse extends ObjectResponseBase
{

    use HasID;
    
    protected $target = '/';
   
    protected function getWorkingObject()
    {
        if (!$object = Objects::load($this->id)) {
            throw new SunhillUserException("The object with the id ':id' does not exist.",['id'=>$this->id]);
        }
        
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
//          $object->attributes = [];
        }  
        $object->tags = [];
    } 
    
}  
    
