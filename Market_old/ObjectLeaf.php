<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;

abstract class ObjectLeaf extends PseudoLeaf
{

    abstract protected function getAllowedFields();
    
    protected function getSubroutedMetadata(string $first, Response &$response, array $remains)
    {
        
    }
        
    protected function getObjectValue(string $first, array $remains)
    {
        // Overwrite in children    
    }
    
    protected function getSubroutedValue(string $first, array $remains)
    {
        if (!in_array($first, $this->getAllowedFields())) {
            return;
        }
        if (!$result = $this->getObjectValue($first,$remains)) {
            return;
        }
        if (is_a($result,Element::class)) {
            return $result->getValue($remains);
        } else {
            return $result;
        }
    }
       
    protected function setObjectValue(string $first, $value, array $remains)
    {
        
    }
    
    protected function setSubroutedValue(string $first, $value, array $remains)
    {
        if (!in_array($first, $this->getAllowedFields())) {
            return;
        }
        if (!$result = $this->getObjectValue($first,$remains)) {
            return;
        }
        if (is_a($result,Element::class)) {
            return $result->setValue($value,$remains);
        } else {
            return $this->setObjectValue($first, $value, $remains);
        }        
    }
        
    protected function isSubroutedAllowedToRead(string $first, string $credentials, array $remains): bool
    {
        
    }
    
    
    protected function isSubroutedAllowedToWrite(string $first, string $credentials, array $remains): bool
    {
        
    }
    
    public function getDeepOffer()
    {
        $name = $this->getName();
        $result = [];
        foreach ($this->getAllowedFields() as $field) {
            $result[] = $name.'.'.$field;
        }
        return $result;
    }
    
}