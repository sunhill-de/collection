<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Sunhill\ORM\Facades\Objects;
use Sunhill\Collection\Response\Database\Common\PropertiesCollectionDialogResponse;
use Sunhill\ORM\Facades\Classes;

class ObjectsDialogResponse extends PropertiesCollectionDialogResponse
{

    protected $route_base = 'objects';
    
    protected function getNamespaceOfCollection(): string
    {
        return Classes::getNamespaceOfClass($this->collection);
    }
    
    protected function getLookup(): string
    {
        return 'objectfield';
    }
    
    protected function execAdd($parameters)
    {
    }
    
    protected function getEditValues()
    {
        return [
            
        ];
    }
    
    protected function execEdit($parameters)
    {
    }
    
    
}  
