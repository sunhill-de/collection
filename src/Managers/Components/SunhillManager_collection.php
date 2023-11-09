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

trait SunhillManager_collection
{
    // ****************************** Collection helpers *************************************
    /**
     * Searches for a staff job with the given name. If none found return null
     * @param string $job
     * @return null|EventType
     * Test: SunhillManagerTest::testSearchEventType
     */
    public function searchEventType(string $name)
    {
        if ($result =  EventType::search()->where('name',$name)->first()) {
            return Collections::loadCollection('EventType', $result->id);
        }
    }
    
    /**
     * Searches for a event type with the given name. if none found create one and return it
     * @param string $job
     * @return EventType
     * Test: SunhillManagerTest::testSearchOrInsertEventType
     */
    public function searchOrInsertEventType(string $name): EventType
    {
        if ($result = $this->searchEventType($name)) {
            return $result;
        }
        $result = new EventType();
        $result->name = $name;
        $result->commit();
        return $result;
    }
    
    /**
     * Searches for a language with the given name. If none found return null
     * @param string $language
     * @return null|Language
     * Test: SunhillManagerTest::testSearchLanguage
     */
    public function searchLanguage(string $language)
    {
        if ($result =  Language::search()->where('name',$language)->first()) {
            return Collections::loadCollection('Language', $result->id);
        }
    }
    
    /**
     * Searches for a language with the given name. if none found create one and return it
     * @param string $job
     * @return StaffJob
     * Test: SunhillManagerTest::testSearchOrInsertLanguage
     */
    public function searchOrInsertLanguage(string $language, string $iso=''): Language
    {
        if ($result = $this->searchLanguage($language)) {
            return $result;
        }
        $result = new Language();
        $result->name = $language;
        $result->iso = $iso;
        $result->commit();
        return $result;
    }
    
    /**
     * Searches for a staff job with the given name. If none found return null
     * @param string $job
     * @return null|StaffJob
     * Test: SunhillManagerTest::testSearchStaffJob
     */
    public function searchStaffJob(string $job)
    {
        if ($result =  StaffJob::search()->where('name',$job)->first()) {
            return Collections::loadCollection('StaffJob', $result->id);
        }
    }
    
    /**
     * Searches for a staff job with the given name. if none found create one and return it
     * @param string $job
     * @return StaffJob
     * Test: SunhillManagerTest::testSearchOrInsertStaffJob
     */
    public function searchOrInsertStaffJob(string $job): StaffJob
    {
        if ($result = $this->searchStaffJob($job)) {
            return $result;
        }
        $result = new StaffJob();
        $result->name = $job;
        $result->commit();
        return $result;
    }
    
    protected function calculateCollectionCount(string $namespace, array $filter = [])
    {
        return $namespace::query()->count();
    }
    
    public function getCollectionCount(string $collection_name, array $filter = [])
    {
        return $this->calculateCollectionCount(Collections::searchCollection($collection_name));    
    }
    
    protected function getCollectionListEntries($namespace, $query_base, int $offset = 0, int $limit = 10)
    {
        if ($offset) {
            $query_base->offset($offset);
        }
        $query_base->limit($limit);
        $entries = $query_base->get();
        $result = [];
        foreach ($entries as $entry) {
            $collection = Collections::loadCollection($namespace, $entry->id);
            $result[] = $this->getTableRow($collection);
        }
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
    public function getCollectionList(string $collection_name, array $conditions = [], string $order = 'id', string $order_direction = 'asc', int $offset = 0, int $limit = 10)
    {
        $namespace = Collections::searchCollection($collection_name);
        $query = $this->buildCollectionQuery($namespace, $conditions, $order, $order_direction);
        return $this->getCollectionListEntries($namespace, $query, $offset, $limit);
    }
    
    public function getCollectionListParameters(string $collection_name, array $conditions = [], string $order = 'id', string $order_direction = 'asc', int $offset = 0, int $limit = 10)
    {
        $namespace = Collections::searchCollection($collection_name);
        $query = $this->buildCollectionQuery($namespace, $conditions, $order, $order_direction);
        return [
            'collectionname'=>$namespace::getInfo('name'),            
            'description'=>$namespace::getInfo('description'),
            'editable'=>$namespace::getInfo('editable'),
            'groupeditable'=>$this->getGroupEditable($namespace),
            'instantiable'=>$namespace::getInfo('instantiable'),
            'total_count'=>$query->count(),
            'filter'=>$conditions,
            'order'=>$order,
            'order_direction'=>$order_direction,
            'offset'=>$offset,
            'limit'=>$limit
        ];
    }
        
}