<?php
/**
 * @file ResponseElement.php
 * Basic class for Types, Semantics and Units that define a name
 * Lang en
 * Reviewstatus: 2022-11-06
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Response;

use Sunhill\Basic\Loggable;

/**
 * Basic class for Types, Semantics and Units that define a name
 * @author klaus
 *
 */
class ResponseElement extends Loggable
{
    
    /**
     * Stores the name of the element
     * @var unknown
     */
    protected $name;

    /**
     * Setter for $name
     * @param string $name
     * @return \Sunhill\InfoMarket\Response\ResponseElement
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Getter for $name
     * @return unknown
     */
    public function getName()
    {
        return $this->name;
    }
    
}
