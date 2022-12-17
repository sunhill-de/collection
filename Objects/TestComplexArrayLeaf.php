<?php

namespace Sunhill\InfoMarket\Tests\Objects;

use Sunhill\InfoMarket\Market\ArrayLeaf;

class TestComplexArrayLeaf extends ArrayLeaf
{
    
    protected $values = [];
    
    public function __construct()
    {
        $this->values[] = new TestSimpleArrayLeaf(1);
        $this->values[] = new TestSimpleArrayLeaf(2);
        $this->values[] = new TestSimpleArrayLeaf(3);
    }
    
    protected function getCount(string $filter): int
    {
        return 3;
    }
    
    protected function getIndexValue(int $index, array $remains, string $order, string $filter)
    {
        return $this->values[$index];
    }
    
}
