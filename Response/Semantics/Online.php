<?php
/**
 * @file Online.php
 * The semantic unit Online represents if a server or service is online
 * Lang en
 * Reviewstatus: 2022-12-21
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Response\Semantics;

class Online extends Semantic
{
    public function __construct()
    {
        $this->setName('Online');
    }
  
}
