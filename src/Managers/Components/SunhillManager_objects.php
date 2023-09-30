<?php
/**
 * @file SunhillManager_collections.php
 * A trait for better overview that deals with handling of collections
 * Lang en
 * Reviewstatus: 2023-09-13
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies:
 */

namespace Sunhill\Collection\Managers\Components;

use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Facades\Classes;

trait SunhillManager_objects
{
    protected function handleObjectConditions($query, array $conditions)
    {
        foreach ($conditions as $condition) {
            
        }
        return $query;
    }
    
    public function getObjectsCount(string $class_name, array $conditions)
    {
        $class_namespace = Classes::getNamespaceOfClass($class_name);
        return $this->handleObjectConditions($class_namespace::search(), $conditions)->count();        
    }
    
    protected function getObjectListEntries($namespace, $query_base, int $offset = 0, int $limit = 10)
    {
        if ($offset) {
            $query_base->offset($offset);
        }
        $query_base->limit($limit);
        $entries = $query_base->get();
        $result = [];
        foreach ($entries as $entry) {
            $object = Objects::load($entry->id);
            $entry->keyfield = $this->getKeyfield($object);
            $result[] = $entry;
        }
        return $result;
    }
    
    public function getObjectsList(string $object_name, array $conditions = [], string $order = 'id', string $order_direction = 'asc', int $offset = 0, int $limit = 10)
    {
        $namespace = Classes::getNamespaceOfClass($object_name);
        $query = $this->buildCollectionQuery($namespace, $conditions, $order, $order_direction);
        return $this->getObjectListEntries($namespace, $query, $offset, $limit);
    }
    
    
}