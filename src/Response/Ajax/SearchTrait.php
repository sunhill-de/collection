<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\ORM\Properties\Property;
use Sunhill\ORM\Facades\Collections;

trait SearchTrait
{
    
    protected function searchInPropertyCollection(string $collection, Property $field, string $search)
    {
        $input = $collection::getInfo('keyfield');
        preg_match_all('/\:([A-Za-z_0-9\->]+)/s',$input,$matches);
        $query = $collection::search();
        foreach ($matches[1] as $match) {
            $query->orWhere($match, 'contains', $search);
        }
        $return = [];
        foreach ($query->get() as $result) {
            $return[] = $this->makeStdclass(['label'=>$result->name,'id'=>$result->id]);
        }
        return $return;        
    }
    
    protected function searchCollection(string $collection, Property $field, string $search)
    {
        $collection_name = Collections::searchCollection($field->getAllowedCollection());
        return $this->searchInPropertyCollection($collection_name, $field, $search);
    }
    
    protected function searchObject(string $object, Property $field, string $search)
    {
        
    }
    
}