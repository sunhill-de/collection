<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\Basic\Loggable;
use Sunhill\InfoMarket\Response\Response;

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
     * Stores the path (without name) that leads to this element
     * @var string
     */
    protected $path = '';
    
    /**
     * Stores the owner (parent) of this element
     * @var Element
     */
    protected $owner = null;
    
    /**
     * Stores the calculated parameters that lead to this path
     * @var array
     */
    protected $params = [];
    
    /**
     * Stores the current response object
     * @var Response
     */
    protected $response;
    
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
     * Getter for $path
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;    
    }
    
    /**
     * Setter for $path
     * @param string $path
     * @return Element
     */
    public function setPath(string $path): Element
    {
        $this->path = $path;
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
     * Adds a param to the $param field
     * @param string $key
     * @param unknown $value
     * @return Element
     * Test Unit/Market/ElementTest::testParams
     */
    public function addParam(string $key, $value): Element
    {
        $this->params[$key] = $value;
        return $this;
    }
    
    /**
     * Checks if the param is defined
     * @param string $key
     * @return unknown
     * Test Unit/Market/ElementTest::testParams
     */
    public function hasParam(string $key)
    {
        return isset($this->params[$key]);    
    }
    
    /**
     * Gets a param from the $param field (or null if it doesn't exist)
     * @param string $key
     * @return unknown|NULL
     * Test Unit/Market/ElementTest::testParams
     */
    public function getParam(string $key)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        } else {
            return null;
        }
    }
    
    /**
     * Return the whole params array
     * @return unknown
     */
    public function getParams()
    {
        return $this->params;
    }
    
    /**
     * Setter for $response
     * @param Response $response
     * @return Element
     */
    public function setResponse(Response $response): Element
    {
        $this->response = $response;
        return $this;
    }
    
    /**
     * Getter for $response
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
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
     * @param string $next
     * @param array $remains
     * @return unknown
     */
    public function getElement(string $next, array $remains)
    {
        return $this->getThisElement($next, $remains);    
    }
    
    /**
     * Returns the metadata of this element
     * @param Response $response
     * @param array $remains
     */
    abstract protected function getThisMetadata(Response &$response, array $remains = [] );

    public function getMetadata(Response &$response, array $remains = [])
    {
        return $this->getThisMetadata($response, $remains);    
    }
    
    /**
     * Gets the value of this element or null if there is no value
     * @param Response $response
     * @param array $remains
     */
    abstract protected function getThisValue(array $remains = []);
    
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
    abstract protected function setThisValue($value, array $remains = []);
    
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
    abstract protected function isThisAllowedToRead(string $credentials, array $remains = []): bool;
    
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
    abstract protected function isThisAllowedToWrite(string $credentials, array $remains = []): bool;
    
    public function isAllowedToWrite(string $credentials, array $remains = []): bool
    {
        return $this->isThisAllowedToWrite($credentials, $remains);
    }
    
    /**
     * Returns all items that this element offers
     * @param string $filter
     * @param int $depth
     */
    abstract protected function getThisOffer(int $depth);
    
    /**
     * Wrapper for doGetOffer()
     * @param string $filter
     * @param int $depth
     * @return unknown
     */
    public function getOffer(int $depth = 0)
    {
        if ($depth < 0) {
            return;
        }
        return $this->getThisOffer(($depth==0)?2147483647:$depth);
    }
}