<?php
/**
 * @file Type.php
 * Stores information about the type of an information
 * Lang en
 * Reviewstatus: 2022-11-03
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Response;

use Sunhill\Basic\Loggable;

class Type extends Loggable 
{
    protected $name;
    
    public function __construct(string $name = "")
    {
        parent::__construct();
        $this->setName($name);
    }
    
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
}