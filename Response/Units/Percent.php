<?php
/**
 * @file Percent.php
 * The unit %
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

class Percent extends Unit
{
    public function __construct()
    {
        $this->setName('Percent');
    }
  
    public function getHumanReadableUnit()
    {
        return "%";
    }

}
