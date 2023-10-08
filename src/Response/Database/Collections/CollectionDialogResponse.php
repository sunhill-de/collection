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

class CollectionDialogResponse extends SunhillDialogResponse
{

    use GetProperties;
    
    protected $id;
    
    protected $collection;
    
    protected $route_base = 'collection';
    
    public function setID(int $id)
    {
        $this->id = $id;
        $this->route_parameters['id'] = $this->id;
        $namespace = Collections::searchCollection($this->collection);
        if (!$namespace::search()->where('id',$id)->count()) {
            throw new InvalidIDException("The id '$id' is invalid.");
        }
        return $this;
    }
    
    public function setCollection(string $collection)
    {
        $this->collection = $collection;
        $this->route_parameters['collection'] = $collection;
        return $this;
    }
    
    protected function defineDialog(DialogDescriptor $descriptor)
    {
        $namespace = Collections::searchCollection($this->collection);
        
        $properties = $namespace::getAllPropertyDefinitions();
        foreach ($properties as $property) {
            switch ($property::class) {
                case PropertyVarchar::class:
                    $element = $descriptor->string();
                    break;
            }
            $element->label($property->get_description())->name($property->getName())->required()->class('input is-small');
            
        }
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
