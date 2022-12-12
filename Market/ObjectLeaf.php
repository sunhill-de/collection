<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\InfoMarketException;

/**
 * Class for a object like leaf
 * @author klaus
 *
 */
abstract class ObjectLeaf extends Element
{
    
    abstract protected function getAllowedFields();
    
    protected function getObjectValue(string $name, array $remaining)
    {
        // Do nothing by default
    }
    
    /**
     * Overwrites the inherited method to check for typical array fields (like count or all)
     * {@inheritDoc}
     * @see \Sunhill\InfoMarket\Market\Element::getThisValue()
     */
    protected function getThisValue(array $remains = [])
    {
        $element = array_shift($remains);
        if (in_array($element,$this->getAllowedFields())) {
            $value = $this->getObjectValue($element, $remains);
            if (is_a($value,Element::class)) {
                return $value->getValue($remains);
            } else {
                return $value;
            }
        }
    }
    
    protected function setObjectValue(string $first, $value, $remaining)
    {
        // No nothing by default    
    }
    
    /**
     * Overwrites the inherited method to handle array fields
     * {@inheritDoc}
     * @see \Sunhill\InfoMarket\Market\Element::setThisValue()
     */
    protected function setThisValue($value, array $remains = [])
    {
        $element = array_shift($remains);
        if (in_array($element,$this->getAllowedFields())) {
            $old_value = $this->getObjectValue($element, $remains);
            if (is_a($old_value,Element::class)) {
                return $old_value->setValue($value,$remains);
            } else {
                return $this->setObjectValue($element, $value, $remains);
            }
        }
    }
    
    protected function getThisElement(string $next, array $remains)
    {
        
    }
    
    protected function getThisMetadata(Response &$response, array $remains = [] )
    {
        $response->update('late');
        $this->checkFields($remains, $index, $order, $filter);
        switch ($index) {
            case 'count':
                $response->type('Integer')->semantic('Count')->unit('None')->setElement('readable',true)->setElement('writeable',false);
                break;
        }
    }
    
    protected function collectThisOffer(array &$result, bool $flat, string $credentials)
    {
        
    }
    
    protected function collectThisNodes(string $credentials): array
    {
    }
}