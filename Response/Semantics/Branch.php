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
}
