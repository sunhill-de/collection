<?php

namespace Sunhill\Collection\Response\Database\Collections;

use Sunhill\Collection\Traits\GetProperties;
use Sunhill\Visual\Response\SunhillUserException;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Response\Dialog\SunhillDialogResponse;
use Sunhill\Collection\Exceptions\InvalidIDException;
use Sunhill\Visual\Response\Dialog\DialogDescriptor;
use Sunhill\ORM\Facades\Collections;
use Sunhill\ORM\Properties\PropertyVarchar;
use Sunhill\ORM\Properties\PropertyArray;
use Sunhill\ORM\Properties\PropertyBoolean;
use Sunhill\ORM\Properties\PropertyCollection;
use Sunhill\ORM\Properties\PropertyDate;
use Sunhill\ORM\Properties\PropertyDatetime;
use Sunhill\ORM\Properties\PropertyEnum;
use Sunhill\ORM\Properties\PropertyFloat;
use Sunhill\ORM\Properties\PropertyInformation;
use Sunhill\ORM\Properties\PropertyInteger;
use Sunhill\ORM\Properties\PropertyMap;
use Sunhill\ORM\Properties\PropertyObject;
use Sunhill\ORM\Properties\PropertyText;
use Sunhill\ORM\Properties\PropertyTime;
use Sunhill\Collection\Response\Database\Common\PropertiesCollectionDialogResponse;

class CollectionDialogResponse extends PropertiesCollectionDialogResponse
{

    use GetProperties;
    
    protected $route_base = 'collection';
    
    function getNamespaceOfCollection(): string
    {
        return Collections::searchCollection($this->collection);
    }
    
    
    protected function getLookup(): string
    {
        return 'collectionfield';
    }
    
    protected function returnAfterExec()
    {
        $this->redirect('collection.list',['collection'=>$this->collection]);        
    }
    
    protected function handleRouteParameter(string $collection)
    {
        $this->route_parameters['collection'] = $collection;
    }
    
    protected function execAdd($parameters)
    {
        $namespace = Collections::searchCollection($this->collection);
        $collection = new $namespace();
        $properties = $namespace::getAllPropertyDefinitions();
        foreach ($properties as $property) {
            $name = $property->getName();
            $collection->$name = $parameters[$name];
        }
        $collection->commit();
        $this->redirect('collection.list',['collection'=>$this->collection]);
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
