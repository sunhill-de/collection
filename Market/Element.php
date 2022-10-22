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
     * Tries to route the given $path
     * @param string $path
     * @param Response $response
     */
    abstract protected function doRoute(string $element, array $remains, string $credentials, Response &$response);
    
    /**
     * Is called whenever there is no routing left (so we must have a leaf or an error)
     * @param string $credentials
     * @param Response $response
     */
    abstract protected function routeFinished(string $credentials, Response &$response);
    
    /**
     * Wrapper for doTryToRoute
     * @param string $path
     * @param Response $response
     * @return unknown
     */
    public function route(array $parts, string $credentials, Response &$response): bool
    {
        if (!empty($parts)) {
            $first = array_shift($parts);
            return $this->doRoute($first,$parts,$credentials,$response);
        } else {
            return $this->routeFinished($credentials,$response);
        }
    }
    
    /**
     * Returns all items that this element offers
     * @param string $filter
     * @param int $depth
     */
    abstract protected function doGetOffer(string $credentials, string $filter, int $depth);
    
    /**
     * Wrapper for doGetOffer()
     * @param string $filter
     * @param int $depth
     * @return unknown
     */
    public function getOffer(string $credentials = 'anybody', string $filter = '', int $depth = 0)
    {
        return $this->doGetOffer($credentials, $filter, ($depth==0)?2147483647:$depth);
    }
}