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

class AjaxCollectionField extends AjaxSearchResponse
{
    
    use SearchTrait;
    
    protected function assembleSearchResult(string $search)
    {
        if (empty($namespace = Collections::searchCollection($this->parameter1))) {
            throw new UnknownCollectionException("The collection '".$this->parameter1."' does not exist.");
        }
        if (empty($field = $namespace::getPropertyObject($this->parameter2))) {
            throw new UnknownFieldException("The collection '".$this->parameter1."' does not have a field '".$this->parameter2."'.");
        }
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