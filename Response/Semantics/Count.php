<?php
/**
 * @file Branch.php
 * The semantic unit Count is used to indicate a count of objects
 * Lang en
 * Reviewstatus: 2022-12-05
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Response\Semantics;

class Count extends Semantic
{
    public function __construct()
    {
        $this->setName('Count');
    }
    
    // A name uses the default processing of Semantic    
}
