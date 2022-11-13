<?php
/**
 * @file DegreeCelsius.php
 * The unit °C
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

class Degreecelsius extends Unit
{
    public function __construct()
    {
        $this->setName('DegreeCelsius');
    }
  
    public function getHumanReadableUnit()
    {
        return "°C";
    }

}
