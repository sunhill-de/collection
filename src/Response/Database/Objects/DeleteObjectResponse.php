<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\RedirectResponse;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Objects;
use Sunhill\Visual\Response\SunhillRedirectResponse;

class DeleteObjectResponse extends SunhillRedirectResponse
{
    
    protected $target = '/';

    protected function getWorkingObject()
    {
        $object_id = request()->input('id');
        $object = Objects::load($object_id);        
        
        $this->clearLists($object);
        $this->target = SunhillSiteManager::getCurrentFeaturePath().'/Show/'.$object_id;
        
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
            $object->$name = [];
          }
          $object->tags = [];
//          $object->attributes = [];
        }  
    }  
}  
    
