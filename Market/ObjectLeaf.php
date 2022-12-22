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
    
    protected function isThisAllowedToWrite(string $credentials, array $remains = []): bool
    {
        $first = array_shift($remains);
        $metadata = $this->callSpecialMethod("getObjectMetadata", $first, $remains);
        return $metadata['writeable'] && (isset($metadata['write_restrictions'])?($this->checkRestriction($metadata['write_restriction'], $credentials)):true);
    }
    
    protected function isThisAllowedToRead(string $credentials, array $remains = []): bool
    {
        $first = array_shift($remains);
        if (empty($first)) {
            return true;
        }
        $metadata = $this->callSpecialMethod("getObjectMetadata", $first, $remains);
        return $metadata['readable'] && (isset($metadata['read_restrictions'])?($this->checkRestriction($metadata['read_restriction'], $credentials)):true);
    }
    
    protected function getObjectValue(string $name, array $remaining)
    {
        // Do nothing by default
    }

    protected function callSpecialMethod(string $base, string $element, array $remaining, $payload = null)
    {
        $method = $base.'_'.$element;
        if (method_exists($this,$method)) {
            if (is_null($payload)) {
                return $this->$method($remaining);
            } else {
                return $this->$method($remaining, $payload);
            }
        } else {
            if (is_null($payload)) {
                return $this->$base($element, $remaining);
            } else {
                return $this->$base($element, $payload, $remaining);
            }                
        }
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
            $value = $this->callSpecialMethod("getObjectValue", $element, $remains);
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
            $old_value = $this->callSpecialMethod("getObjectValue", $element, $remains);
            if (is_a($old_value,Element::class)) {
                return $old_value->setValue($value,$remains);
            } else {
                return $this->callSpecialMethod("setObjectValue", $element, $remains, $value);
            }
        }
    }

    protected function getObjectElement(string $element, array $remaining)
    {
        $result = new \StdClass();
        $result->element = $this;
        $result->remains = $remaining;
        return $result;    
    }
    
    protected function getThisElement(string $next, array $remaining)
    {
        if (in_array($next,$this->getAllowedFields())) {
            array_unshift($remaining, $next);
            return $this->callSpecialMethod("getObjectElement", $next, $remaining);
        } else {
            return false;
        }
    }
    
    protected function getObjectMetadata(string $next, array $remains)
    {
        
    }
    
    protected function getThisMetadata(Response &$response, array $remains = [] )
    {
        $first = array_shift($remains);
        if (in_array($first, $this->getAllowedFields())) {
            $metadata = $this->callSpecialMethod("getObjectMetadata", $first, $remains);
            foreach ($metadata as $key => $value) {
                switch ($key) {
                    case 'semantic':
                        $response->Semantic($value);
                        break;
                    case 'unit':
                        $response->Unit($value);
                        break;
                    case 'type':
                        $response->Type($value);
                        break;
                    default:
                        $response->setElement($key, $value);
                }
            }
            if ($response->getElement('readable')) {
                array_unshift($remains, $first);
                $value = $this->getValue($remains);
                $response->value($value);
            }
            return true;
        } else {
            return false;
        }
    }
    
    protected function collectThisOffer(array &$result, bool $flat, string $credentials)
    {
        
    }
    
    protected function collectThisNodes(string $credentials): array
    {
        $result = [];
        foreach ($this->getAllowedFields() as $field) {
            $response = new Response();
            $this->getMetadata($response, [$field]);
            $result[] = $this->createNode($field,$response);
        }
        return $result;
    }
}