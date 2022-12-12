<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\InfoMarket\Market\ArrayLeaf;

class SimpleFeatureArray extends ArrayLeaf
{
  
    protected $values = [2,4,6];
  
    protected function getCount(): int
    {
        return 3;
    }
  
    protected function getIndexValue(int $index, array $remains)
    {
        return $this->values[$index];
    }
    
    protected function setIndexValue(int $index, $value, array $remains)
    {
        $this->values[$index] = $value;
    }

}  
