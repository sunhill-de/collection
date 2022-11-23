<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;

abstract class Leaf extends Element
{
    
    /**
     * In this case (we are a leaf) the best fitting element is $this
     * @param string $next
     * @param array $remains
     * Test tests/Unit/Market/LeafTest::testGetThisElement
     */
    protected function getThisElement(string $next, array $remains)
    {
        $result = new \StdClass();
        $result->element = $this;
        $result->remains = $remains;
        return $result;
    }
    
    
    /**
     * A leaf returns by default only itself
     * @param int $depth
     * @return string[]
     * test /tests/Unit/Market/LeafTest::testGetThisOffer()
     */
    protected function getThisOffer(int $depth)
    {
        return [$this->getName()];
    }
    
    public function getDeepOffer()
    {
        return [];        
    }
}
