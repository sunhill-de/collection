<?php
/**
 * @file Centimeter.php
 * The cm
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

class Centimeter extends Unit
{
    public function __construct()
    {
        $this->setName('Centimeter');
    }
  
    public function getHumanReadableUnit()
    {
        return "cm";
    }

}
