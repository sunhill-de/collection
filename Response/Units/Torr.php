<?php
/**
 * @file Torr.php
 * The unit mmHg
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

class Torr extends Unit
{
    public function __construct()
    {
        $this->setName('Torr');
    }
  
    public function getHumanReadableUnit()
    {
        return "mmHg";
    }

}
