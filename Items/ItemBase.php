<?php

namespace Sunhill\InfoMarket\Items;

use Sunhill\InfoMarket\Marketeers\MarketeerBase;
use Sunhill\InfoMarket\Marketeers\Response\Response;

abstract class ItemBase
{
    protected $owner;

    protected $metadata;
    
    public function __construct($owner = null)
    {
        $this->owner = $owner; // Can be null
        // Default Metadata
        $this->metadata = [
            'read_restriction'=>'anybody',
            'write_restriction'=>'anybody',
            'readable'=>true,
            'writeable'=>false,
            'unit'=>' ',
            'semantic'=>'name',
            'type'=>'String',
            'update'=>'late'
        ];
        // Makes it possible to overwrite defaults
        foreach ($this->getMetadata() as $key => $value) {
            $this->metadata[$key] = $value;
        }
    }

    /**
     * Could (and should) be overwritten to override default values for metadatas
     * @return array
     */
    protected function getMetadata()
    {
        return [];        
    }
    
    public function getReadRestriction()
    {
        return $this->metadata['read_restriction'];
    }
    
    public function getWriteRestriction()
    {
        return $this->metadata['write_restriction'];
    }
    
    public function getReadable()
    {
        return $this->metadata['readable'];
    }
    
    public function getWriteable()
    {
        return $this->metadata['writeable'];
    }
    
    protected function getUnit()
    {
        return $this->metadata['unit'];
    }

    protected function getSemantic()
    {
        return $this->metadata['semantic'];
    }
    
    protected function getType()
    {
        return $this->metadata['type'];
    }
    
    protected function getUpdate()
    {
        return $this->metadata['update'];
    }
    
    public function buildMetadata()
    {
        $response = new Response();
        $response =  $response
        ->OK()
        ->setElement('readable',$this->getReadable())
        ->setElement('writeable',$this->getWriteable())
        ->unit($this->getUnit())
        ->semantic($this->getSemantic())
        ->type($this->getType())
        ->update($this->getUpdate());
        
        if ($this->getReadable()) {
            $response = $response
            ->value($this->getItemValue())
            ->setElement('read_restriction',$this->getReadRestriction());            
        }
        if ($this->getWriteable()) {
            $response = $response
            ->setElement('write_restriction',$this->getWriteRestriction());            
        }
           
        return $response;
    }
    
    protected function getItemValue()
    {
        
    }
 
    protected function setItemValue($value)
    {
        
    }
    
    public function getValue(string $answer = 'json')
    {
        $value = $this->getItemValue();
        $response = new Response();
        return $response->unit($this->getUnit())->OK()->value($value)->get($answer);
    }

    public function setValue($value)
    {
        $this->setItemValue($value);
    }

    /**
     * 
     * @param string $filter
     * @param number $depth
     */
    public function getFullOffering(string $filter = '', $depth = 0)
    {
        
    }
}