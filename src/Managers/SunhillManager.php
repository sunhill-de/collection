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

class SunhillManager
{
    
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
    
}
