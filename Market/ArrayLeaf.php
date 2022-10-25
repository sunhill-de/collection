<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\InfoMarketException;

abstract class ArrayLeaf extends PseudoLeaf
{
    protected $remains_allowed = true;
    
    protected function doGetItemValue(Response &$response, array $remains = [])
    {
        if (empty($remains)) {
            throw new InfoMarketException(__('Array leaf called without a parameter'));
        }
        $element = array_shift($remains);
        
        if ($element == 'count') {
            return $this->getItemCount($response, $remains);
        } else if (is_numeric($element)) {
            $element = intval($element);
            if (($element >= 0) && ($element < $this->getItemCount($response, $remains))) {
                return $this->doGetIndexedItemValue($element, $response, $remains);
            } else {
                throw new InfoMarketException(__("Index ':index' out of range.", ['index'=>$element]));
            }
        } else {
            throw new InfoMarketException(__("Can't handle array parameter ':parameter'.", ['parameter'=>$element]));            
        }
    }
    
    abstract protected function doGetIndexedItemValue(int $index, Response &$response, array $remains = []);
    abstract protected function doSetIndexedItemValue(int $index, $value, Response &$response, array $remains = []);
    abstract protected function getItemCount(Response $response, array $remains = []): int;
    
}