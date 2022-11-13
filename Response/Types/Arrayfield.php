<?php
/**
 * @file Arrayfield.php
 * Represents an array
 * Lang en
 * Reviewstatus: 2022-11-06
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Response\Types;

class Arrayfield extends Type
{
    public function __construct()
    {
        $this->setName('ArrayField');
    }
    
}
