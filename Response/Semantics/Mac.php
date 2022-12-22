<?php
/**
 * @file MAC.php
 * The semantic unit MAC represents a MAC-Address
 * Lang en
 * Reviewstatus: 2022-12-20
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Response\Semantics;

class MAC extends Semantic
{
    public function __construct()
    {
        $this->setName('MAC');
    }
    
    public function getParent(): string
    {
        return 'Name';
    }
  
}
