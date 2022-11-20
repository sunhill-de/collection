<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;

abstract class Item extends Leaf
{
    
    /**
     * This are the default metadata and should be overwritten by derrived items
     * @var array
     */
    private $default_metadata = [
        'read_restriction'=>'anybody',
        'write_restriction'=>'anybody',
        'readable'=>true,
        'writeable'=>false,
        'unit'=>' ',
        'semantic'=>'name',
        'type'=>'Str',
        'update'=>'late'
    ];
    
    /**
     * In this array the overwritten metadata should be stored. it is later mixed with default metadata
     * @var array
     */
    protected $metadata = [];
    
    /**
     * The constructor overwrites the default metadata values with the ones 
     * defined for this item
     * Test /tests/Unit/Market/ItemTest::testOverride()
     */
    public function __construct()
    {
        parent::__construct();
        // Overwrite the defaults (if necessary)
        $this->default_metadata = $this->mergeMetadata($this->default_metadata,$this->metadata);
    }

    protected function isReadable()
    {
        return $this->default_metadata['readable'];
    }
    
    protected function isWriteable()
    {
        return $this->default_metadata['writeable'];
    }
    
    protected function getReadRestriction()
    {
        return $this->default_metadata['read_restriction'];
    }
    
    protected function getWriteRestriction()
    {
        return $this->default_metadata['write_restriction'];
    }
    
    protected function isThisAllowedToRead(string $credentials, array $remains = []): bool
    {
        return $this->checkRestriction($this->getReadRestriction(),$credentials);
    }
    
    protected function isThisAllowedToWrite(string $credentials, array $remains = []): bool
    {
        return $this->checkRestriction($this->getWriteRestriction(),$credentials);
    }
    
    protected function getUnit()
    {
        return $this->default_metadata['unit'];
    }
    
    protected function getSemantic()
    {
        return $this->default_metadata['semantic'];
    }
    
    protected function getType()
    {
        return $this->default_metadata['type'];
    }
    
    protected function getUpdate()
    {
        return $this->default_metadata['update'];
    }
    
    protected function getThisMetadata(Response &$response, array $remains = [])
    {
        $response
        ->OK()
        ->setElement('readable',$this->isReadable())
        ->setElement('writeable',$this->isWriteable())
        ->unit($this->getUnit())
        ->semantic($this->getSemantic())
        ->type($this->getType())
        ->update($this->getUpdate());
        if ($this->isReadable()) {
            $response
            ->setElement('read_restriction',$this->getReadRestriction());
        }
        if ($this->isWriteable()) {
            $response
            ->setElement('write_restriction',$this->getWriteRestriction());
        }
        return true;
    }
            
    /**
     * As an extension to the leaf function only return $this when $remains is empty
     * @param string $next
     * @param array $remains
     */
    protected function getThisElement(string $next, array $remains)
    {
        if (empty($remains)) {
            return parent::getThisElement($next, $remains);
        } else {
            return null;
        }        
    }
    
    /**
     * Gets the value of this element or null if there is no value
     * @param Response $response
     * @param array $remains
     */
    final protected function getThisValue(array $remains = [])
    {
        if (empty($remains)) {
            return $this->getItemValue($remains);
        } else {
            return null;
        }
    }

    abstract protected function getItemValue();
    
    /**
     * Sets the value of this element or ignores the request if it's not possible to set a value
     * @param unknown $value
     * @param array $remains
     */
    final protected function setThisValue($value, array $remains = [])
    {
        if (empty($remains)) {
            return $this->setItemValue($value,$remains);            
        } else {
            return null;
        }
    }
    
}