<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;

abstract class Item extends Leaf
{
    

    
    /**
     * As an extension to the leaf function only return $this when $remains is empty
     * @param string $next
     * @param array $remains
     */
    protected function getThisElement(string $next, array $remains)
    {
        if (empty($remains)) {
            return parent::getThisElement($next, $remains);
        } else {
            return null;
        }        
    }
    
    /**
     * Gets the value of this element or null if there is no value
     * @param Response $response
     * @param array $remains
     */
    final protected function getThisValue(array $remains = [])
    {
        if (empty($remains)) {
            return $this->getItemValue($remains);
        } else {
            return null;
        }
    }

    abstract protected function getItemValue();
    
    /**
     * Sets the value of this element or ignores the request if it's not possible to set a value
     * @param unknown $value
     * @param array $remains
     */
    final protected function setThisValue($value, array $remains = [])
    {
        if (empty($remains)) {
            return $this->setItemValue($value,$remains);            
        } else {
            return null;
        }
    }
    
}