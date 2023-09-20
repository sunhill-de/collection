<?php
/**
 * @file SunhillManager_keyfields.php
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

use Sunhill\ORM\Objects\PropertiesCollection;

trait SunhillManager_keyfields
{

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
    
}