<?php
/**
 * @file Type.php
 * Stores information about the type of an information
 * Lang en
 * Reviewstatus: 2022-11-03
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Response\Types;

use Sunhill\InfoMarket\Response\ResponseElement;

class Type extends ResponseElement
{
    /**
     * Somethimes the input value has to be processed to another form. This can be done here
     * @return The processes value
     */
    public function processValue($value)
    {
        return $value;
    }    
    
    /**
     * Somethimes the input value has to be processed to another form to be readable. This can be done here
     * @return The processes value
     */
    public function processHumanReadableValue($value)
    {
        return $value;
    }    
}
