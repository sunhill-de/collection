<?php

namespace Sunhill\Collection\Response\Database\Collection;

use Sunhill\ORM\Facades\Collections;
use Sunhill\Collection\Response\Database\Common\PropertiesCollectionCrudResponse;

class CollectionCrudResponse extends PropertiesCollectionCrudResponse
{
    
    protected static $route_base = 'collection';
    
    protected function getNamespace(): string
    {
        return Collections::searchCollection($this->collection)->class;
    }
    
}