<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\ORM\Properties\Property;
use Sunhill\ORM\Facades\Collections;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Collection\Facades\SunhillManager;
use Sunhill\ORM\Facades\Objects;

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
        return $query->get();
    }
    
    protected function convertObjectResult($query)
    {
        $return = [];
        foreach ($query as $result) {
            $object = Objects::load($result->id);
            $return[] = $this->makeStdclass(['label'=>SunhillManager::getKeyfield($object),'id'=>$result->id]);
        }
        return $return;        
    }
    
    protected function convertCollectionResult($query, $collection)
    {
        $return = [];
        foreach ($query as $result) {
            $object = Collections::loadCollection($collection, $result->id);
            $return[] = $this->makeStdclass(['label'=>SunhillManager::getKeyfield($object),'id'=>$result->id]);
        }
        return $return;        
    }
    
    protected function searchCollection(string $collection, Property $field, string $search)
    {
        $collection_name = Collections::searchCollection($field->getAllowedCollection());
        return $this->convertCollectionResult($this->searchInPropertyCollection($collection_name, $field, $search), $collection_name);
    }
    
    protected function searchObject(string $object, Property $field, string $search)
    {
        $result = [];
        $allowed_classes = $field->getAllowedClasses();
        if (!is_array($allowed_classes)) {
            $allowed_classes = [$allowed_classes];
        }
        foreach ($field->getAllowedClasses() as $allowed_class) {
            $namespace = Classes::getNamespaceOfClass($allowed_class);
            $search_result = $this->convertObjectResult($this->searchInPropertyCollection($namespace, $field, $search));
            $result = array_merge($result, $search_result);
        }
        
        return $result;
    }
    
}