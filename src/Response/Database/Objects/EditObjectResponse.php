<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\Collection\Utils\HasID;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Utils\ObjectList;
use Sunhill\Collection\Traits\GetProperties;

class EditObjectResponse extends SunhillBladeResponse
{

    use GetProperties, HasID;
    
    protected $template = 'collection::objects.edit';
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $object_id = $this->id;
        $object = Objects::load($object_id);        
        $classnamespace = $this->getNamespace($object);
        
        $fields = $object->getProperties()->where('editable',true)->get();
        $this->params['fields'] = $fields;
        $this->params['classname'] = $object::getInfo('name');
        $this->params['object'] = $object;
    }
    
}  
