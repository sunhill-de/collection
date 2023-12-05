<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxSearchResponse;
use Illuminate\Support\Facades\DB;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Facades\InfoMarket;
use Sunhill\ORM\Facades\Collections;
use Sunhill\Collection\Exceptions\UnknownCollectionException;
use Sunhill\Collection\Exceptions\UnknownFieldException;
use Sunhill\Collection\Exceptions\UnsearchableFieldException;
use Sunhill\ORM\Properties\PropertyCollection;
use Sunhill\ORM\Properties\PropertyObject;
use Sunhill\ORM\Properties\PropertyArray;

abstract class AjaxPropertiesCollectionField extends AjaxSearchResponse
{
    
    use SearchTrait;
    
    abstract protected function searchNamespace(string $name): string;
    
    protected function getPropertryObject(string $namespace, string $field)
    {
        if (empty($field = $namespace::getPropertyObject($field))) {
            throw new UnknownFieldException("The collection '".$this->parameter1."' does not have a field '$field'.");
        }  
        return $field;
    }
    
    protected function assembleSearchResult(string $search)
    {
        $namespace = $this->searchNamespace($this->parameter1);
        $field = $this->getPropertryObject($namespace, $this->parameter2);
        
        switch ($field::class) {
            case PropertyCollection::class:
                return $this->searchCollection($namespace, $field, $search);
            case PropertyObject::class:
                return $this->searchObject($namespace, $field, $search);
                break;
            case PropertyArray::class:
                if ($field->getElementType() == PropertyCollection::class) {
                    return $this->searchCollection($namespace, $field, $search);
                } else if ($field->getElementType() == PropertyObject::class) {
                    return $this->searchObject($namespace, $field, $search);
                }
            default:
                throw new UnsearchableFieldException("The field '".$this->parameter2."' of collection '".$this->parameter1."' is not searchable.");
        }
    }
    
}