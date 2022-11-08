<?php
/**
 * @file Lux.php
 * The unit lx
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

class Lux extends Unit
{
    public function __construct()
    {
        $this->setName('Lux');
    }
  
    public function getHumanReadableUnit()
    {
        return "lx";
    }

}
