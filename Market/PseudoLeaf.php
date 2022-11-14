<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;

/**
 * A pseudo leaf is a element that appears to be a leaf (it has a final destination in a marketeer) but
 * is able to process further routing informations. Examples for pseudo leafs are arrays or objects. For 
 * sake of simplicity, pseudo leafs have to process further informations (otherwise they are items).
 * Example:
 * In a marketeer there is a leaf with the destination "this.is.a.test". Via the market comes the request 
 * for "this.a.a.test.for.a.pseduo.leaf". This is routet to this leaf with the remaining "for.a.pseudo.leaf"
 * informations. These a passed to the pseudo leaf and are further processed by them (or not, if the pseudo 
 * leaf can't process them) 
 * @author klaus
 */
abstract class PseudoLeaf extends Leaf
{

    protected function getSubroutedMetadata(string $first, Response &$response, array $remains)
    {
        
    }
    
    final protected function getThisMetadata(Response &$response, array $remains = [] )
    {
        if (empty($remains)) {
            $response->OK()->semantic('Branch')->type('Branch')->unit('None');
            return null;
        }
        $first = array_shift($remains);
        
        return $this->getSubroutedMetadata($first, $response, $remains);
    }
    
    protected function getSubroutedValue(string $first, array $remains)
    {
        
    }
    
    final protected function getThisValue(array $remains = [])
    {
        if (empty($remains)) {
            return $this->getName();
        }
        $first = array_shift($remains);
    
        return $this->getSubroutedValue($first, $remains);
    }
    
    protected function setSubroutedValue(string $first, $value, array $remains)
    {
        
    }
    
    protected function setThisValue($value, array $remains = [])
    {
        if (empty($remains)) {
            return null;
        }
        $first = array_shift($remains);
        
        return $this->setSubroutedValue($first, $value, $remains);
    }

    protected function isSubroutedAllowedToRead(string $first, string $credentials, array $remains): bool
    {
        
    }
    
    protected function isThisAllowedToRead(string $credentials, array $remains = []): bool
    {
        return true;
        if (empty($remains)) {
            return false;
        }
        $first = array_shift($remains);
        
        return $this->isSubroutedAllowedToRead($first, $value, $remains);        
    }
    
    protected function isSubroutedAllowedToWrite(string $first, string $credentials, array $remains): bool
    {
        
    }
    
    protected function isThisAllowedToWrite(string $credentials, array $remains = []): bool
    {
        if (empty($remains)) {
            return false;
        }
        $first = array_shift($remains);
        
        return $this->isSubroutedAllowedToWrite($first, $value, $remains);
    }
        
}