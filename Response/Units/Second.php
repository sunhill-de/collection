<?php
/**
 * @file Second.php
 * The unit s
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

class Second extends Unit
{
    public function __construct()
    {
        $this->setName('Second');
    }
  
    public function getHumanReadableUnit()
    {
        return "s";
    }

}
