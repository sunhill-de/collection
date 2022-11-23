<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\Basic\Loggable;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\InfoMarketException;

/**
 * Basic class for the InfoMarket
 * @author klaus
 *
 */
abstract class Element extends Loggable
{
    
    /**
     * Stores the name of this element
     * @var string
     */
    protected $name;
    
    /**
     * Stores the owner (parent) of this element
     * @var Element
     */
    protected $owner = null;
            
    /**
     * Returns a merge metadata array for further processing
     * @param array $override
     * Test tests/Unit/Market/LeafTest::testMergeMetadata
     */
    protected function mergeMetadata(array $default, array $override)
    {
        foreach ($override as $key => $value) {
            $default[$key] = $value;
        }
        return $default;
    }
    
    /**
     * Checks if the given restriction ($user) fits to the required one ($restriction)
     * @param string $restriction
     * @param string $user
     * @throws MarketeerException
     * @return boolean|unknown
     * Test /Unit/Market/LeadTest::testCheckRestrion()
     */
    protected function checkRestriction(string $restriction, string $user)
    {
        switch ($restriction) {
            case 'anybody':
                return true;
            case 'user':
                return in_array($user,['user','advanced','admin']);
            case 'advanced':
                return in_array($user,['advanced','admin']);
            case 'admin':
                return $user == 'admin';
            default:
                throw new InfoMarketException("Unkown user group '$restriction'");
        }
    }
    
    /**
     * Getter for $name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * Setter for $name
     * @param string $name
     * @return \Sunhill\InfoMarket\Market\Element
     */
    public function setName(string $name): Element
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * getter for owner
     * @return Element
     */
    public function getOwner(): Element
    {
        return $this->owner;
    }
    
    /**
     * Setter for owner
     * @param Element $owner
     * @return \Sunhill\InfoMarket\Market\Element
     */
    public function setOwner(Element $owner)
    {
        $this->owner = $owner;
        return $this;
    }
    
    /**
     * Tries to return the best avaiable element or null if none found
     * @param string $next The next part of the search (the one that this item has to process first)
     * @param array $remains The remaining parts of the search
     * @return \StdClass|false
     */
    abstract protected function getThisElement(string $next, array $remains);
    
    /**
     * Wrapper for getThisElement()
     * @param string $next either the already splitrest (then there is no dot in the string
     * or the unsplit request. It latter case we have to seperate it
     * @param array $remains The remaining path elements (per default [])
     * @return Element or null if there is none 
     */
    public function getElement(string $next, array $remains = [])
    {
        if (strpos($next,'.') !== false) {
            $remains = explode('.',$next);
            $next = array_shift($remains);
        }
        return $this->getThisElement($next, $remains);
    }
    
    /**
     * Returns the metadata of this element
     * @param Response $response
     * @param array $remains
     */
    abstract protected function getThisMetadata(Response &$response, array $remains = [] );
    
    /**
     * Wrapper for getThisMetadata
     * @param Response $response
     * @param array $remains
     * @return unknown
     */
    public function getMetadata(Response &$response, array $remains = [])
    {
        $this->getThisMetadata($response, $remains);
        if ($response->getElement('readable')) {
            $response->value($this->getValue($remains));
        } 
        return true;
    }
    
    /**
     * Gets the value of this element or null if there is no value
     * @param Response $response
     * @param array $remains
     */
    protected function getThisValue(array $remains = [])
    {
        return null;
    }
    
    /**
     * Wrapper for getThisValue
     * @param array $remains
     */
    public function getValue(array $remains = [])
    {
        return $this->getThisValue($remains);
    }
    
    /**
     * Sets the value of this element or ignores the request if it's not possible to set a value
     * @param unknown $value
     * @param array $remains
     */
    protected function setThisValue($value, array $remains = [])
    {
        return; // Per default ignore request
    }
    
    /**
     * Wrapper for setThisValue
     * @param unknown $value
     * @param array $remains
     * @return unknown
     */
    public function setValue($value, array $remains = [])
    {
        return $this->setThisValue($value, $remains);
    }
    
    /**
     * Returns if the current user is allowed to read this element
     * @param string $credentials
     * @param array $remains
     * @return bool
     */
    protected function isThisAllowedToRead(string $credentials, array $remains = []): bool
    {
        return true;
    }    
    
    public function isAllowedToRead(string $credentials, array $remains = []): bool
    {
        return $this->isThisAllowedToRead($credentials, $remains);
    }
    
    /**
     * Returns if the current user is allowed to read this element
     * @param string $credentials
     * @param array $remains
     * @return bool
     */
    protected function isThisAllowedToWrite(string $credentials, array $remains = []): bool
    {
        return false;
    }    
    
    public function isAllowedToWrite(string $credentials, array $remains = []): bool
    {
        return $this->isThisAllowedToWrite($credentials, $remains);
    }
    
    /**
     * Returns all next path element that this element offers
     * @param string $filter
     * @param int $depth
     */
    protected function collectThisOffer(array &$result, bool $flat, string $credentials)
    {
        return; // Per default do nothing
    }    
    
    /**
     * Wrapper for collectThisOffer()
     * @param string $filter
     * @param int $depth
     * @return unknown
     */
    final public function collectOffer(array &$result, bool $flat = true, string $credentials = 'anybody')
    {
        return $this->collectThisOffer($result, $flat, $credentials);
    }
    
    /**
     * Returns all leafes that come out of this element
     * Per default none
     */
    protected function collectThisNodes(string $credentials): array
    {
        return []; // Per default no nodes
    }
    
    /**
     * Wrapper for collectThisNodes
     */
    final public function collectNodes(string $credentials = 'anybody'): array
    {
        return $this->collectThisNodes($credentials);
    }
        
}
