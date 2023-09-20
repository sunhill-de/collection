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
    protected function getObjectListEntries($namespace, $query_base, int $offset = 0, int $limit = 10)
    {
        if ($offset) {
            $query_base->offset($offset);
        }
        $query_base->limit($limit);
        $entries = $query_base->get();
        $result = [];
        foreach ($entries as $entry) {
            $collection = Objects::load($entry->id);
            $row = $this->getTableRow($collection);
            
            $result[] = $row;
        }
        return $result;
    }
    
    public function getObjectList(string $object_name, array $conditions = [], string $order = 'id', string $order_direction = 'asc', int $offset = 0, int $limit = 10)
    {
        $namespace = Classes::getNamespaceOfClass($object_name);
        $query = $this->buildCollectionQuery($namespace, $conditions, $order, $order_direction);
        return $this->getObjectListEntries($namespace, $query, $offset, $limit);
    }
    
    
}