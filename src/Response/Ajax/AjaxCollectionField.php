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

class AjaxCollectionField extends AjaxPropertiesCollectionField
{
    
    protected function searchNamespace(string $name): string
    {
        if (empty($collection = Collections::searchCollection($name))) {
            throw new UnknownCollectionException("The collection '$name' does not exist.");
        }
        return $collection->class;
    }    
    
}