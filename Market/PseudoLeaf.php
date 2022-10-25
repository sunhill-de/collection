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

    /**
     * A pseudo leaf needs more routing information, so if we get here, it is a mistake
     * {@inheritDoc}
     * @see \Sunhill\InfoMarket\Market\Leaf::routeFinished($credentials, $response)
     */
    protected function routeFinished(string $credentials, Response &$response)
    {
        $resonse->error("Too few routing informations","TOFEWINFORMATIONS");
        return false;
    }
    
    /**
     * Pseudo leafs must have more routing informations
     * {@inheritDoc}
     * @see \Sunhill\InfoMarket\Market\Leaf::doRoute()
     */
    protected function doRoute(string $element, array $remains, string $credentials, Response &$response)
    {
        switch ($response->getElement('method')) {
            case 'get':
                return $this->getItem($remains, $credentials, $response);
            case 'set':
                return $this->setItem($remains, $response->getElement('value'), $credentials, $response);                
        }
    }
    
    protected function getItem(array $remains, string $credentials, Response &$response)
    {
        if (!$this->isAllowedForReading($credentials, $response, $remains)) {
            $response->error('USERNOTALLOWEDTOREAD',__("The current user ':credentials' is not allowed to read the item ':name'",['credentials'=>$credentials, 'name'=>$response->getElement('request')]));
            return true;
        }
        $this->getMetadata($response, $remains);
        if ($this->isReadable($response, $remains)) {
            $response->value($this->doGetItemValue($remains, $response));
        }
        return true;
    }
    
    protected function setItem(array $remains, $value, string $credentials, Response &$response)
    {
        if (!$this->isWriteable($response, $remains)) {
            $response->error('ITEMNOTWRITEABLE',__("The item ':name' is not writeable",['name'=>$response->getElement('request')]));
            return true;
        }
        if (!$this->isAllowedForWriting($credentials, $response, $remains)) {
            $response->error('USERNOTALLOWEDTOWRITE',__("The current user ':credentials' is not allowed to write the item ':name'",['credentials'=>$credentials, 'name'=>$response->getElement('request')]));
            return true;
        }
        $this->getMetadata($response, $remains);
        
        // The response includes the previous value
        if ($this->isReadable($response, $remains) && $this->isAllowedForWriting($credentials, $response, $remains)) {
            $response->value($this->doGetItemValue($remains, $response));
        }
        $this->doSetItemValue($remains, $value, $response);
        return true;
        
    }
    
    protected function doGetItemValue(array $remains, Response &$response)
    {
        return true;
    }
    
    protected function doSetItemValue(array $remains, $value, Response &$response)
    {
        return true;
    }
    
}