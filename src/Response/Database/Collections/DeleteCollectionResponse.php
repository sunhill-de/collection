<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Objects;
use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\Visual\Response\SunhillUserException;
use Sunhill\Collection\Utils\HasID;

class DeleteObjectResponse extends SunhillRedirectResponse
{
    
    use HasID;
    
    protected $target = '/';

    protected function prepareResponse()
    {
        if (!$object = Objects::load($this->id)) {
            throw new SunhillUserException(__("The object with the id ':id' does not exist.",['id'=>$this->id]));
        }
        $object->delete();
        $this->setTarget(route('objects.list'));        
    }
    
}  
    
