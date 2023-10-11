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
                case PropertyArray::class:
                    $element = $descriptor
                                ->list()
                                ->element($property->getElementType()::getType())
                                ->lookup('collectionfield')
                                ->lookup_additional($this->collection,$property->getName());
                    break;
                case PropertyBoolean::class:
                    $element = $descriptor->checkbox();
                    break;
                case PropertyCollection::class:
                    $element = $descriptor
                                ->inputLookup()
                                ->lookup('collectionfield')
                                ->lookup_additional($this->collection,$property->getName());
                    break;
                case PropertyDate::class:
                    $element = $descriptor->date();
                    break;
                case PropertyDatetime::class:
                    $element = $descriptor->datetime();
                    break;
                case PropertyEnum::class:
                    $element = $descriptor->select();
                    $values = [];
                    foreach ($property->getEnumValues() as $value) {
                        $values[$value] = $value;
                    }
                    $element->entries($values);
                    break;
                case PropertyFloat::class:
                    $element = $descriptor->string();
                    break;
                case PropertyInformation::class:
                    $element = $descriptor->string();
                    break;
                case PropertyInteger::class:
                    $element = $descriptor->number();
                    break;
                case PropertyMap::class:
                    $element = $descriptor->inputLookup()->lookup('collectionfield')->lookup_additional($this->collection,$property->getName());
                    break;
                case PropertyObject::class:
                    $element = $descriptor->inputLookup()->lookup('collectionfield')->lookup_additional($this->collection,$property->getName());
                    break;
                case PropertyText::class:
                    $element = $descriptor->text();
                    break;
                case PropertyTime::class:
                    $element = $descriptor->time();
                    break;
                case PropertyVarchar::class:
                    $element = $descriptor->string();
                    break;
            }
            $element->label($property->get_description())->name($property->getName())->class('input is-small');
            if (!empty($property->getDefault())) {
                $element->required();
            }
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
