<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Utils\ObjectList;
use Sunhill\Collection\Traits\GetProperties;

/**
 * A baseclass for adding oder modifying objects
 */
abstract class ObjectResponseBase extends SunhillRedirectResponse
{

    use GetProperties;
    
    abstract protected function getWorkingObject();    
      
    protected function prepareResponse()
    {    
        $object = $this->getWorkingObject();
        $fields = $this->getEditable($object);

        foreach ($fields as $field) {
          $property = $object->getProperty($field->name);  
          $fieldname = $property->getName();
          $fieldtype = $property->getType();
          $handler = 'get'.$fieldtype;
          if (!method_exists($this,'get'.$fieldtype)) {
              throw new \Exception(__("No handler for ':fieldtype'",['fieldtype'=>$fieldtype]));
          }
          $value = $this->$handler(request()->input($fieldname,null),$property);
          
          if (is_array($value)) {
              foreach ($value as $single) {
                  $object->$fieldname[] = $single;
              }
          } else {
              if (!is_null($value)) {
                $object->$fieldname = $value;
              }
          }
        }
        if (request()->has('tags')) {
            $this->getTags($object);
        }
        $this->getAttributes($object);   
        $object->commit();
    }

    protected function getVarchar($value,$field)
    {
        return substr($value,0,$field->getMaxLen());           
    }
    
    protected function getInteger($value,$field)
    {
        if (empty($value)) {
            return null;
        }
        if (!is_numeric($value)) {
            throw new \Exception(__("':value' is not an integer",['value'=>$value]));            
        }
        return $value;
    }
    
    protected function getFloat($value,$field)
    {
        if (empty($value)) {
            return null;
        }
        if (!is_float($value)) {
            throw new \Exception(__("':value' is not an float",['value'=>$value]));
        }
        return $value;
    }
    
    protected function getText($value,$field)
    {
        return $value;        
    }
    
    protected function getEnum($value,$field)
    {
        if (empty($value)) {
            return null;
        }
        $allowed = $field->getEnumValues();
        if (!in_array($value,$allowed)) {
            throw new \Exception(__("':value' is not an allowed value",['value'=>$value]));
        }
        return $value;
    }

    private function isAllowed($value,$list)
    {
        foreach ($list as $entry) {
            if (Classes::isA($value,$entry)) {
                return true;
            }
        }
        return false;
    }

    protected function isAllowedObject($test, $allowed_objects)
    {
        if (is_numeric($test)) {
            $test = Objects::getClassNameOf(intval($test));
        }
        foreach ($allowed_objects as $object) {
            if (Classes::isA($test,$object)) {
                return true;
            }
        }
        return false;
    }
    
    protected function checkAndCreateObject($value, $field)
    {
        if (empty($value)) {
            return null;
        }
        if (!is_numeric($value)) {
            throw new \Exception(__("':value' is not an object-id",['value'=>$value]));
        }
        $value = Objects::load(intval($value));
        if (empty($value)) {
            throw new \Exception(__("':value' is not a valid object id",['value'=>$value]));
        }
        if (!$this->isAllowedObject($value,$field->getAllowedObjects())) {
            throw new \Exception(__("':value' is not an allowed object for this field",['value'=>$value]));
        }
        return $value;        
    }
    
    protected function getObject($value,$field)
    {
        return $this->checkAndCreateObject(request()->input($field->getName()), $field);
    }
    

    protected function getArrayOfStrings($value, $field)
    {
        $value = request()->input($field->getName());
        return $value;
    }
    
    protected function getArrayOfObjects($value, $field)
    {
        $result = [];
        $values = request()->input($field->getName());
        if (!empty($values)) {
            foreach ($values as $value) {
                $result[] = $this->checkAndCreateObject($value, $field);
            }
        }
        return $result;
    }
    
    /**
     * @todo Implement value checks
     * @param unknown $value
     * @param unknown $field
     * @return unknown
     */
    protected function getDate($value,$field)
    {
        if (empty($value)) {
            return null;
        }
        return $value;        
    }
    
    /**
     * @todo Implement value checks
     * @param unknown $value
     * @param unknown $field
     * @return unknown
     */
    protected function getTime($value,$field)
    {
        if (empty($value)) {
            return null;
        }
        return $value;
        
    }
    
    /**
     * @todo Implement value checks
     * @param unknown $value
     * @param unknown $field
     * @return unknown
     */
    protected function getDateTime($value,$field)
    {
        if (empty($value)) {
            return null;
        }
        return $value;       
    }
    
    protected function getTags($object)
    {
        $tags = request()->input('tags');
        foreach ($tags as $tag) {
            $object->tags->stick($tag);                 
        }
    }
    
    protected function getAttributes($object)
    {        
        $avaiable = Attributes::getAvaiableAttributesForClass($object::getInfo('name'));
        foreach ($avaiable as $candidate) {
            $name = $candidate->name;
            if (request()->has($name)) {
                $object->$name = request()->input($name);
            }
        }
    }
}  
    
