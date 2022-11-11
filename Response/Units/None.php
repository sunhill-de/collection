<?php
/**
 * @file None.php
 * No unit at all
 * Lang en
 * Reviewstatus: 2022-11-06
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Response\Units;

class None extends Unit
{
    public function __construct()
    {
        $this->setName('None');
    }
  
    public function getHumanReadableUnit()
    {
        return "";
    }

}
