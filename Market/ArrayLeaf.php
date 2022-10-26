<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\InfoMarketException;

abstract class ArrayLeaf extends PseudoLeaf
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
    
    abstract function doGetArrayCount(Response &$response): int;
     
    protected function getMetadata(Response &$response, array $remains = [])
    {
        
    }
    
     protected function getArrayCount(Response &$response)
     {
         return 
         $response
            ->OK()
            ->setElement('readable',true)
            ->setElement('writeable',false)
            ->unit(' ')
            ->semantic('count')
            ->type('Integer')
            ->update('asap')
            ->setElement('read_restriction',$this->getReadRestriction($response, $remains))
            ->value($this->doGetArrayCount($response));
     }
     
     protected function doGetItemValue(array $remains, Response &$response)
     {
         $first = array_shift($remains);
         if ($first == 'count') {
             return $this->getArrayCount($remains, $response);
         } else if (is_numeric(first)) {
             $index = intval($first);
             return 
         }
     }
     
     protected function doSetItemValue(array $remains, $value, Response &$response)
     {
         return true;
     }
     
     protected function getIndexValue(int $index, Response &$response)
     {
         return true;
     }
     
     protected function setIndexValue(int $index, $value, Response &$response)
     {
         return true;         
     }
}