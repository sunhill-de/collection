<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Properties\Utils\DefaultNull;
use Sunhill\Visual\Response\Crud\SunhillCrudResponse;
use Sunhill\Visual\Response\Crud\DialogDescriptor;
use Sunhill\Collection\Response\Database\Common\PropertiesCollectionCrudResponse;
use Sunhill\ORM\Facades\Objects;

class ObjectsCrudResponse extends PropertiesCollectionCrudResponse
{
    
    protected static $route_base = 'objects';

    protected static $entity = 'object';
    
    protected function getNamespace(): string
    {
        return Classes::getNamespaceOfClass($this->collection);
    }
 
    protected function getPropertiesHavingObject(int $id)
    {
        return Objects::load($id);
    }
 
}