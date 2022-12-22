<?php
/**
 * @file Branch.php
 * The semantic unit Branch is used for the type of a branch
 * Lang en
 * Reviewstatus: 2022-11-08
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Response\Semantics;

class Branch extends Semantic
{
    public function __construct()
    {
        $this->setName('Branch');
    }
    
    // A name uses the default processing of Semantic  
    /**
     * A semantic can process a value and and transform it into another one
     * @return a processes value (by default just pass it through)
     */
    public function processValue($value)
    {
    }
    
    /**
     * With this method it is possible to define a conversion to display a raw value in a human readable one
     * @return string: The human readable representation of value
     */
    public function processHumanReadableValue($value, string $human_readable_unit = ''): string
    {
        return "";
    }
    
}
