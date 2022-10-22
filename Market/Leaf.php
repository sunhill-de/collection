<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;

abstract class Leaf extends Element
{

    /**
     * If set to true, then it's possible to pass additional data to the item
     * @var boolean
     */
    protected $remains_allowed = false;
    
    /**
     * This are the default metadata and should be overwritten by derrived items
     * @var array
     */
    protected $default_metadata = [
        'read_restriction'=>'anybody',
        'write_restriction'=>'anybody',
        'readable'=>true,
        'writeable'=>false,
        'unit'=>' ',
        'semantic'=>'name',
        'type'=>'String',
        'update'=>'late'        
    ];
        
    protected function doRoute(string $element, array $remains, string $credentials, Response &$response)
    {
        if ($this->remains_allowed) {
            switch ($response->getElement('method')) {
                case 'get':
                    return $this->getItem($credentials,$response,$remains);
                case 'set':
                    return $this->setItem($response->getElement('value'),$credentials,$response,$remains);
            }
        } else {
            return false;
        }
    }
    
    protected function routeFinished(string $credentials, Response &$response)
    {
        switch ($response->getElement('method')) {
            case 'get':
                return $this->getItem($credentials,$response);
            case 'set':
                return $this->setItem($response->getElement('value'),$credentials,$response);
        }        
    }
        
    protected function isReadable($response, $remains)
    {
        return $this->default_metadata['readable']; 
    }
    
    protected function isWriteable($response, $remains)
    {
        return $this->default_metadata['writeable'];
    }
    
    protected function getReadRestriction(Response $response, array $remains)
    {
        return $this->default_metadata['read_restriction'];    
    }
    
    protected function getWriteRestriction(Response $response, array $remains)
    {
        return $this->default_metadata['write_restriction'];
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
                throw new MarketeerException(__("Unkown user group ':restriction'",['restriction'=>$restriction]));
        }        
    }
    
    protected function isAllowedForReading(string $credentials, Response $response, array $remains)
    {
        return $this->checkRestriction($this->getReadRestriction($response, $remains),$credentials);
    }
    
    protected function isAllowedForWriting(string $credentials, Response $response, array $remains)
    {
        return $this->checkRestriction($this->getWriteRestriction($response, $remains),$credentials);
    }
    
    protected function getUnit($response, $remains)
    {
        return $this->default_metadata['unit'];    
    }
    
    protected function getSemantic($response, $remains)
    {
        return $this->default_metadata['semantic'];
    }
    
    protected function getType($response, $remains)
    {
        return $this->default_metadata['type'];
    }
    
    protected function getUpdate($response, $remains)
    {
        return $this->default_metadata['update'];
    }
    
    protected function getMetadata(string $credentials, Response &$response, array $remains)
    {
        if (!$this->isAllowedForReading($credentials, $response, $remains)) {
            $response->error('USERNOTALLOWEDTOREAD',__("The current user ':credentials' is not allowed to read the item ':name'",['credentials'=>$credentials, 'name'=>$response->getElement('request')]));
            return true;
        }
        $response
        ->OK()
        ->setElement('readable',$this->isReadable($response, $remains))
        ->setElement('writeable',$this->isWriteable($response, $remains))
        ->unit($this->getUnit($response, $remains))
        ->semantic($this->getSemantic($response, $remains))
        ->type($this->getType($response, $remains))
        ->update($this->getUpdate($response, $remains));
        if ($this->isReadable($response, $remains)) {
            $response
            ->value($this->doGetItemValue($response, $remains))
            ->setElement('read_restriction',$this->getReadRestriction($response, $remains));
        }
        if ($this->isWriteable($response, $remains)) {
            $response
            ->setElement('write_restriction',$this->getWriteRestriction($response, $remains));
        }        
    }
    
    protected function getItem(string $credentials, Response &$response, array $remains = [])
    {
        $this->getMetadata($credentials, $response, $remains);
        return true;
    }
    
    protected function setItem($value, string $credentials, Response &$response, array $remains = [])
    {
        if (!$this->isWriteable($credentials, $response, $remains)) {
            $response->error('ITEMNOTWRITEABLE',__("The item ':name' is not writeable",['name'=>$response->getElement('request')]));
            return true;            
        }
        if (!$this->isAllowedForWriting($credentials, $response, $remains)) {
            $response->error('USERNOTALLOWEDTOWRITE',__("The current user ':credentials' is not allowed to write the item ':name'",['credentials'=>$credentials, 'name'=>$response->getElement('request')]));
            return true;
        }
        $this->getMetadata($credentials, $response, $remains);
        $this->doSetItemValue($value, $response, $remains);
        return true;
    }
    
    protected function doGetOffer(string $credentials, string $filter, int $depth)
    {
        return [$this->getName()];
    }
    
    abstract protected function doGetItemValue(Response &$response, array $remains = []);
    
    protected function doSetItemValue($value, Response &$response, array $remains = [])
    {
        return true;
    }
}