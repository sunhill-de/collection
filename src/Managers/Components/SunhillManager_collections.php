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

use Sunhill\Collection\Collections\StaffJob;
use Sunhill\ORM\Facades\Collections;
use Sunhill\Collection\Collections\Language;
use Sunhill\Collection\Collections\EventType;
use Sunhill\ORM\Managers\CollectionManager;

trait SunhillManager_collections
{
    
    public function getCollectionsCount()
    {
        return count(Collections::getRegisteredCollections());    
    }
    
    protected function getCollectionListEntry(string $name, string $namespace)
    {
        $result = new \StdClass();
        
        $result->name = $name;
        $result->namespace = $namespace;
        $result->description = $namespace::getInfo('description');
        return $result;
    }
    
    /**
     * Returns the entries of a list of the given collection with the given conditions, orderings and limitations
     * @param string $collection_name
     * @param array $conditions
     * @param string $order
     * @param string $order_direction
     * @param int $offset
     * @param int $limit
     * @return array of array of string
     */
    public function getCollectionsList(array $conditions = [], string $order = 'id', string $order_direction = 'asc', int $offset = 0, int $limit = 10)
    {
        $result = Collections::getRegisteredCollections();
        $return = [];
        if ($offset >= count($result)) {
            throw new \Exception("Offset out of range.");
        }
        foreach ($result as $key => $value) {
            $return[] = $this->getCollectionListEntry($key, $value);
        }
            
        return $return;
    }
    
    protected function getCollectionCount(string $namespace)
    {
        return $namespace::search()->count();
    }
    
    public function getCollectionsInformations(string $classname)
    {
        $namespace = Collections::searchCollection($classname);
        return [
            'namespace'=>$namespace,
            'description'=>$namespace::getInfo('description'),
            'collectionname'=>$classname,
            'tablename'=>$namespace::getInfo('table'),
            'editable'=>$namespace::getInfo('editable'),
            'instantiable'=>$namespace::getInfo('instantiable'),
            'object_count'=>make_link(route('collection.list',$classname),$this->getCollectionCount($namespace)),
            'properties'=>$this->getClassProperties($namespace),
        ];
    }
}