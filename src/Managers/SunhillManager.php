<?php
/**
 * @file SunhillManager.php
 * A manager with routines for the sunhill collection
 * Lang en
 * Reviewstatus: 2023-09-13
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: 
 */

namespace Sunhill\Collection\Managers;

use Sunhill\Collection\Collections\StaffJob;
use Sunhill\ORM\Facades\Collections;
use Sunhill\Collection\Collections\Language;
use Sunhill\Collection\Collections\EventType;
use Sunhill\ORM\Objects\PropertiesCollection;

class SunhillManager
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
    
// ******************************** List helpers **********************************************
    protected function getTableColumn(PropertiesCollection $collection, string $column)
    {
        if (strpos($column,'->') === false) {
            if ($column == 'keyfield') {
                $result = $this->getKeyfield($collection);
            } else {
                $result = $collection->$column;
            }
            return $result;
        } else {
            list($field,$subfield) = explode('->',$column);
            $field = $collection->$field;
            if (empty($field)) {
                return '';
            }
            if ($subfield == 'keyfield') {
                return $this->getKeyfield($field);    
            }
            return $field->$subfield;
        }
    }
    
    /**
     * Replaces all occurances of :XXXX with $collection->XXXX
     * @param PropertiesCollection $collection
     * @param string $input
     * @return string
     */
    protected function replaceVariables(PropertiesCollection $collection, string $input): string
    {
        preg_match_all('/\:([A-Za-z_0-9\->]+)/s',$input,$matches);
        foreach ($matches[1] as $match) {
            $input = str_replace(':'.$match,$this->getTableColumn($collection,$match),$input);
        }
        return $input;
    }

    protected function replaceConditionalFields(PropertiesCollection $collection, string $input): string
    {
        preg_match_all('/(\S+)\?(\S+)/s', $input, $matches);
        for ($i=0;$i<count($matches[0]);$i++) {
            $result = $this->getTableColumn($collection, $matches[1][$i]);
            if (empty($result)) {
                $input = str_replace($matches[0][$i],'', $input);
            } else {
                $input = str_replace($matches[0][$i], 
                                     $this->replaceVariables($collection, $matches[2][$i]),
                                     $input);
            }
        }        
        return $input;
    }
    
    /**
     * Returns the defines keyfield or just uuid if no keyfield was set
     * @param PropertiesCollection $collection
     * @return unknown
     */
    public function getKeyfield(PropertiesCollection $collection)
    {
        $keyfield = $collection::getInfo('keyfield', ':_uuid');

        $keyfield = $this->replaceConditionalFields($collection, $keyfield);
        $keyfield = $this->replaceVariables($collection, $keyfield);        
        return $keyfield;        
    }
    
    protected function getTableRow(PropertiesCollection $collection)
    {
        $result = [];
        
        foreach ($collection::getInfo('table_columns',['uuid'=>'_uuid']) as $name => $column) {
            if (is_numeric($name)) {
                $result[$column] = $this->getTableColumn($collection, $column);                
            } else {
                $result[$name] = $this->getTableColumn($collection, $column);
            }
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
        $query = $namespace::search();
        foreach ($conditions as $condition) {
            $query->where($condition['key'],$condition['relation'],$condition['value']);
        }
        $query->orderBy($order, $order_direction);
        if ($offset) {
            $query->offset($offset);
        }
        $query->limit($limit);
        
        $entries = $query->get();
        
        $result = [];
        foreach ($entries as $entry) {
            $collection = Collections::loadCollection($namespace, $entry->id);
            $result[] = $this->getTableRow($collection);
        }
        return $result;
    }
}
