<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;

abstract class Item extends Leaf
{
    
    protected $metadata = [];
    
    /**
     * The constructor overwrites the default metadata values with the ones 
     * defined for this item
     */
    public function __construct()
    {
        parent::__construct();
        // Overwrite the defaults (if necessary)
        $this->default_metadata = $this->mergeMetadata($this->metadata);
    }
    
    /**
     * Items mustn't have further routing information, so raise an error
     * {@inheritDoc}
     * @see \Sunhill\InfoMarket\Market\Leaf::doRoute()
     */
    protected function doRoute(string $element, array $remains, string $credentials, Response &$response)
    {
        $response->error("TOOMUCHINFORMATION","Too much routing information");
        return false;
    }
  
    /**
     * This is the expected end point for items.
     * {@inheritDoc}
     * @see \Sunhill\InfoMarket\Market\Leaf::routeFinished()
     */
    protected function routeFinished(string $credentials, Response &$response)
    {
        switch ($response->getElement('method')) {
            case 'get':
                return $this->getItem($credentials,$response);
            case 'set':
                return $this->setItem($response->getElement('value'),$credentials,$response);
        }        
    }
    
    /**
     * Whenever the route ends here and the verb is "get" this routine is called. It checks the credentials
     * collects the metadata and calls "doSetItemValue()" to get the value 
     * @param $credentials string the current credentials of the user
     * @param $response Response the current response object
     */
    protected function getItem(string $credentials, Response &$response)
    {
        if (!$this->isAllowedForReading($credentials, $response, [])) {
            $response->error('USERNOTALLOWEDTOREAD',__("The current user ':credentials' is not allowed to read the item ':name'",['credentials'=>$credentials, 'name'=>$response->getElement('request')]));
            return true;
        }
        $this->getMetadata($response);
        if ($this->isReadable($response)) {
            $response->value($this->doGetItemValue($response));
        }
        return true;
    }

    /**
     * Whenever the route ends here and the verb is set this routine is called. It checks the credentials
     * collects the metadata, the previous value (if avaiable) and calls "doSetItemValue()" to change the 
     * value
     * @param $value The new value for this Item
     * @param $credentials string the current credentials of the user
     * @param $response Response the current response object
     */
    protected function setItem($value, string $credentials, Response &$response)
    {
        if (!$this->isWriteable($response)) {
            $response->error('ITEMNOTWRITEABLE',__("The item ':name' is not writeable",['name'=>$response->getElement('request')]));
            return true;
        }
        if (!$this->isAllowedForWriting($credentials, $response)) {
            $response->error('USERNOTALLOWEDTOWRITE',__("The current user ':credentials' is not allowed to write the item ':name'",['credentials'=>$credentials, 'name'=>$response->getElement('request')]));
            return true;
        }
        $this->getMetadata($response);
        // The response includes the previous value
        if ($this->isReadable($response) && $this->isAllowedForWriting($credentials, $response)) {
            $response->value($this->doGetItemValue($response));
        }
        $this->doSetItemValue($value, $response);        
        return true;
    }
    
    /**
     * Implemented as a dummy routine because there are items that are write only.
     * Don't write directly into response, just return the value
     */
    protected function doGetItemValue(Response &$response)
    {
        return true;    
    }
    
    /**
     * Implemented as a dummy routine because there are items that are read only
     */
    protected function doSetItemValue($value, Response &$response)
    {
        return false;
    }
    
    /**
     * As an extension to the leaf function only return $this when $remains is empty
     * @param string $next
     * @param array $remains
     */
    public function getElement(string $next, array $remains)
    {
        if (empty($remains)) {
            return parent::getElement($next, $remains);
        } else {
            return null;
        }
    }
    
    public function getThisMetadata(Response &$response, array $remains = [] )
    {
        $this->getMetadata($response, $remains);
    }
    
    /**
     * Gets the value of this element or null if there is no value
     * @param Response $response
     * @param array $remains
     */
    public function getThisValue(array $remains = [])
    {
        
    }
    
    /**
     * Sets the value of this element or ignores the request if it's not possible to set a value
     * @param unknown $value
     * @param array $remains
     */
    public function setThisValue($value, array $remains = [])
    {
        
    }
    
    /**
     * Returns if the current user is allowed to read this element
     * @param string $credentials
     * @param array $remains
     * @return bool
     */
    public function isAllowedToRead(string $credentials, array $remains = []): bool
    {
        return true;
    }
    
}