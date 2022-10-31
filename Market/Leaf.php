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
     * Returns a merge metadata array for further processing
     * @param array $override
     * Test tests/Unit/Market/LeafTest::testMergeMetadata
     */
    protected function mergeMetadata(array $default, array $override)
    {
        foreach ($override as $key => $value) {
            $default[$key] = $value;
        }
        return $default;
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
    
}