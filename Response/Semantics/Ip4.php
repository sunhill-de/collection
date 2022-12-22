<?php
/**
 * @file IP4.php
 * The semantic unit IP4 represents a IPv4-Address
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

class IP4 extends Semantic
{
    public function __construct()
    {
        $this->setName('IP4');
    }
    
    public function getParent(): string
    {
        return 'Name';
    }
  
}
