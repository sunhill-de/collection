<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\InfoMarketException;

abstract class ArrayLeaf extends PseudoLeaf
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
        'type'=>'String',
        'update'=>'late'
    ];
    
    protected $metadata = [];
    
    /**
     * The constructor overwrites the default metadata values with the ones
     * defined for this item
     */
    public function __construct()
    {
        parent::__construct();
        // Overwrite the defaults (if necessary)
        $this->default_metadata = $this->mergeMetadata($this->default_metadata, $this->metadata);
    }
    
    abstract protected function getCount(): int;
    
    protected function getSubroutedMetadata(string $first, Response &$response, array $remains)
    {
        if ($first == 'count') {
            if (!empty($remains)) {
                $response->error(__("Can't process further routing after count.",['TOOMUCHINFORMATIONAFTERCOUNT']));
                return false;
            }
            $response->OK()
            ->setElement('readable',true)
            ->setWriteable('writeable',false)
            ->unit(' ')
            ->semantic('count')
            ->type('Integer')
            ->update('asap')
            ->setElement('read_restriction','anybody')
            ->value($this->getCount());
        } else if (is_numeric($first)) {
            $response->OK()
            ->setElement('readable',$this->default_metadata['readable'])
            ->setWriteable('writeable',$this->default_metadata['writeable'])
            ->unit($this->default_metadata['unit'])
            ->semantic($this->default_metadata['semantic'])
            ->type($this->default_metadata['type'])
            ->update($this->default_metadata['update'])
            ->setElement('read_restriction',$this->default_metadata['read_restrictions'])
            ->value($this->getSubroutedValue($first, $remains));
            return true;
        } else {
            $response->error(__("Can't interepret :first in arrays.",['first'=>$first]),'UNKNOWNVARIABLEINARRAY');
            return false;
        }
    }
    
    protected function getSubroutedValue(string $first, array $remains)
    {
        if ($first == 'count') {
            if (!empty($remains)) {
                return false;
            }
            return $this->getCount();
        } else if (is_numeric($first)) {
            $index = intval($first);
            return $this->getIndexValue($index, $remains);
        } else {
            return false;
        }
    }
    
    protected function setSubroutedValue(string $first, $value, array $remains)
    {
      if (is_numeric($first)) {
        $index = intval($first);
        return $this->setIndexValue($index, $value, $remains);
      } else {
        return false;
      }    
    }
    
    protected function isSubroutedAllowedToRead(string $first, string $credentials, array $remains): bool
    {
        
    }
    
    protected function isSubroutedAllowedToWrite(string $first, string $credentials, array $remains): bool
    {
        
    }
    
    
     protected function getIndexValue(int $index, array $remains)
     {
         return true;
     }
     
     protected function setIndexValue(int $index, $value, array $remains)
     {
         return true;         
     }
}