<?php

namespace Sunhill\InfoMarket\Tests\Objects;

use Sunhill\InfoMarket\Market\ArrayLeaf;

class TestSimpleArrayLeaf extends ArrayLeaf
{
    public $values = [2,4,6];
    
    public function __construct(int $mult = 1)
    {
        for ($i=0;$i<3;$i++) {
            $this->values[$i] *= $mult;
        }
    }
    
    protected function getCount(string $filter): int
    {
        if ($filter == 'great') {
            return 2;
        } else {
            return 3;
        }
    }
    
    protected function calculateIndex(int $index, string $order, string $filter)
    {
        if ($filter == 'great') {
            if ($order == 'reverse') {
                return 3-($index+1);
            } else {
                return $index+1;
            }
        }
        if ($order == 'index') {
            return $index;
        } else if ($order == 'reverse') {
            return 2-$index;
        }
    }
    
    protected function getIndexValue(int $index, array $remains, string $order, string $filter)
    {
        return $this->values[$this->calculateIndex($index, $order, $filter)];
    }
    
    protected function setIndexValue(int $index, $value, array $remains, string $order, string $filter)
    {
        $this->values[$this->calculateIndex($index, $order, $filter)] = $value;
    }
    
    protected function getAllowedSort(): array
    {
        return ['reverse'];
    }
    
    protected function getAllowedFilter(): array
    {
        return ['great'];
    }
    
    public function pubHasField(&$remains, $test)
    {
        return $this->hasField($remains, $test);
    }
    
    public function pubCheckFields(&$remains, &$index, &$order, &$filter) {
        return $this->checkFields($remains, $index, $order, $filter);
    }
    
}
