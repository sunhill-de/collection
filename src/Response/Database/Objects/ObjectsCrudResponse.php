<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Properties\Utils\DefaultNull;
use Sunhill\Visual\Response\Crud\SunhillCrudResponse;
use Sunhill\Visual\Response\Crud\DialogDescriptor;
use Sunhill\Collection\Response\Database\Common\PropertiesCollectionCrudResponse;

class ObjectsCrudResponse extends PropertiesCollectionCrudResponse
{
    
    protected static $route_base = 'objects';

    protected static $entity = 'objects';
    
    protected function getNamespace(): string
    {
        return Classes::getNamespaceOfClass($this->collection);
    }
        
}