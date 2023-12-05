<?php

namespace Sunhill\Collection\Response\Database\Collection;

use Sunhill\ORM\Facades\Collections;
use Sunhill\Collection\Response\Database\Common\PropertiesCollectionCrudResponse;

class CollectionCrudResponse extends PropertiesCollectionCrudResponse
{
    
    protected static $route_base = 'collection';
    
    protected static $entity = 'collection';
    
    protected function getNamespace(): string
    {
        return Collections::searchCollection($this->collection)->class;
    }
    
    protected function getPropertiesHavingObject(int $id)
    {
        return Collections::loadCollection($this->collection ,$id);
    }
    
    protected function getTitle(string $prefix, $additional = null): string
    {
        if ($additional) {
            return __(':prefix collection ":additional" of type ":type"',['prefix'=>$prefix,'additional'=>$additional,'type'=>$this->collection]);
        } else {
            return __(':prefix collection of type ":type"',['prefix'=>$prefix,'type'=>$this->collection]);            
        }
    }
}