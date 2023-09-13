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

class SunhillManager
{
    
    /**
     * Searches for a staff job with the given name. If none found return null
     * @param string $job
     * @return null|StaffJob
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
     */
    public function searchOrInsertStaffJob(string $job): StaffJob
    {
        if ($result = $this->searchStaffJob($job)) {
            return $result;
        }
        $result = new StaffJob();
        $result->name = $job;
        return $result;
    }
    
}
