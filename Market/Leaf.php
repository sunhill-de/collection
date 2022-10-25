<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;

abstract class Leaf extends Element
{
    
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
        
    /**
     * Returns a merge metadata array for further processing
     * @param array $override
     */
    protected function mergeMetadata(array $override)
    {
        $result = $this->default_metadata;
        foreach ($override as $key => $value) {
            $result[$key] = $value;
        }
        return $result;
    }
    
    protected function isReadable($response, array $remains = [])
    {
        return $this->default_metadata['readable']; 
    }
    
    protected function isWriteable($response, array $remains = [])
    {
        return $this->default_metadata['writeable'];
    }
    
    protected function getReadRestriction(Response $response, array $remains = [])
    {
        return $this->default_metadata['read_restriction'];    
    }
    
    protected function getWriteRestriction(Response $response, array $remains = [])
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
    
    protected function isAllowedForReading(string $credentials, Response $response, array $remains = [])
    {
        return $this->checkRestriction($this->getReadRestriction($response, $remains),$credentials);
    }
    
    protected function isAllowedForWriting(string $credentials, Response $response, array $remains = [])
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
    
    protected function getMetadata(Response &$response, array $remains = [])
    {
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
            ->setElement('read_restriction',$this->getReadRestriction($response, $remains));
        }
        if ($this->isWriteable($response, $remains)) {
            $response
            ->setElement('write_restriction',$this->getWriteRestriction($response, $remains));
        }        
    }
    
    protected function doGetOffer(string $credentials, string $filter, int $depth)
    {
        return [$this->getName()];
    }
    
}