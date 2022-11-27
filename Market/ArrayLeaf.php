<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\InfoMarketException;

/**
 * Class for a simple branch of the info market tree
 * @author klaus
 *
 */
abstract class ArrayLeaf extends Element
{
    abstract protected function getCount(string $filter): int;
    
    /**
     * Tests if the array $remains includes a field beginning $field. If yes, shift it from $remains and 
     * return the field without the prefix
     * @param array $remains
     * @param string $field
     * @return String|boolean
     * @Tests Unit/Market/ArrayLeafTest::testHasField
     */
    protected function hasField(array &$remains, string $field) 
    {
        if (substr($remains[0],0,strlen($field)) == $field) {
            $result = array_shift($remains);
            $result = substr($result,strlen($field));
            return $result;
        }
        return false;
    }
    
    /**
     * Checks the given array $remains for typical array fields. If found set the according fields
     * otherwise fill it with default values 
     * @param array $remains
     * @param unknown $index
     * @param unknown $order
     * @param unknown $filter
     * @throws InfoMarketException
     * @return boolean
     * @test Unit/Market/ArrayLeafTest::testCheckFields
     */
    protected function checkFields(array &$remains, &$index, &$order, &$filter)
    {
        if (empty($remains)) {
            // No additional parameters mean we want to whole array
            $index = 'all';
            return true;
        }        
        
        if (!($order = $this->hasField($remains,'by_'))) {
            $order = 'index';
        } else {
            // Check if this array defines this sorting
            if (!in_array($order, $this->getAllowedSort())) {
                throw new InfoMarketException("'$order' is not an allowed sorting");
            }
        }
        if (!($filter = $this->hasField($remains,'where_'))) {
            $filter = '';
        } else {
            // Check if this array defines this filter
            if (!in_array($filter, $this->getAllowedFilter())) {
                throw new InfoMarketException("'$filter' is not an allowed filter");
            }
            // Because order can come after filter re-check for order
            if (($order == 'index') && !($order = $this->hasField($remains, 'by_'))) {
                $order = 'index';
            } else {
                // And check if this order exists
                if (!in_array($order, $this->getAllowedSort())) {
                    throw new InfoMarketException("'$order' is not an allowed sorting");
                }                
            }
        }
        // At this point $order and $index should be set with values or default values
        
        if (($remains[0] == 'count') || ($remains[0] == 'all')) {
            if (count($remains) > 1) {
                throw new InfoMarketException("Too many parameters for array request.");
            } else {
                $index = $remains[0];
                return true;
            }
        }
        
        if (is_numeric($remains[0])) {
            $index = intval(array_shift($remains));
            if (($index >= 0) && ($index < $this->getCount($filter))) {
                return true;
            } else {
                throw new InfoMarketException("Invalid index '$index' for array");                
            }
        }
        throw new InfoMarketException('Invalid parameters for array');
    }
    
    /**
     * Every array has to overwrite this method, it returns the element $index when ordered by $order 
     * filtered by $filter
     * @param int $index The index of the element. The check, if the index is valid was already performed
     * @param array $remains additional informations for the element (e.g. array of arrays)
     * @param string $order What ordering should be used
     * @param string $filter What filter should be used
     * @test There is no test for this method
     */
    protected function getIndexValue(int $index, array $remains, string $order, string $filter)
    {
    }
    
    /**
     * Returns all values of this array
     * @param array $remains
     * @param string $order
     * @param string $filter
     * @return NULL[]|boolean[]
     * @test Unit/Market/ArrayLeafTest::testGetAll
     */
    protected function getAll(array $remains, string $order, string $filter)
    {
        $result = [];
        for ($i=0;$i<$this->getCount($filter);$i++) {
            $value = $this->getIndexValue($i, $remains, $order, $filter);
            if (is_a($value, Element::class)) {
                $result[] = $value->getValue($remains);                
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }
    
    /**
     * Overwrites the inherited method to check for typical array fields (like count or all)
     * {@inheritDoc}
     * @see \Sunhill\InfoMarket\Market\Element::getThisValue()
     * @test Unit/Market/ArrayLeafTest::testSimpleGetCount
     * @test Unit/Market/ArrayLeafTest::testSimpleGetIndex
     * @test Unit/Market/ArrayLeafTest::testSimpleGetIndexWithOrder
     * @test Unit/Market/ArrayLeafTest::testSimpleGetIndexWithFilter
     * @test Unit/Market/ArrayLeafTest::testIndexException
     * @test Unit/Market/ArrayLeafTest::testComplexGetCount
     * @test Unit/Market/ArrayLeafTest::testComplexGetIndex
     */
    protected function getThisValue(array $remains = [])
    {
        $this->checkFields($remains, $index, $order, $filter);
        switch ($index) {
            case 'count':
                return $this->getCount($filter);
            case 'all':
                return $this->getAll($remains, $order, $filter);
            default:
                if (is_numeric($index)) {
                    $result = $this->getIndexValue(intval($index), $remains, $order, $filter);
                    if (is_a($result, Element::class)) {
                        return $result->getValue($remains);
                    } else {
                        return $result;
                    }
                }
        }
    }
    
    protected function setIndexValue(int $index, $value, array $remains, string $order, string $filter)
    {
    }       
    
    /**
     * Overwrites the inherited method to handle array fields
     * {@inheritDoc}
     * @see \Sunhill\InfoMarket\Market\Element::setThisValue()
     * @test Unit/Market/ArrayLeafTest::testSimpleSetValue
     * @test Unit/Market/ArrayLeafTest::testSimpleSetValueWithFilter
     * @test Unit/Market/ArrayLeafTest::testSimpleSetValueWithOrder
     * @test Unit/Market/ArrayLeafTest::testComplexSetValue
     */
    protected function setThisValue($value, array $remains = [])
    {
        $this->checkFields($remains, $index, $order, $filter);
        if (($index == 'all') || ($index == 'count')) {
            throw new InfoMarketException("Can't set a meta value '$index'");
        }
        $result = $this->getIndexValue(intval($index), $remains, $order, $filter);
        if (is_a($result, Element::class)) {
            return $result->setValue($value, $remains);
        } else {
            return $this->setIndexValue($index, $value, $remains, $order, $filter);            
        }
    }
    
    protected function getThisElement(string $next, array $remains)
    {
    }
    
    protected function getThisMetadata(Response &$response, array $remains = [] )
    {
        $this->checkField($remains);        
    }
    
    protected function collectThisOffer(array &$result, bool $flat, string $credentials)
    {
        
    }
    
    protected function getAllowedSort(): array
    {
        return [];    
    }
    
    protected function getAllowedFilter(): array
    {
        return [];    
    }
    
    protected function collectThisNodes(string $credentials): array
    {
        $result = ['count','all'];
        foreach ($this->getAllowedSort() as $sort) {
            $result[] = 'by_'.$sort;
        }
        foreach ($this->getAllowedFilter() as $filter) {
            $result[] = 'where_'.$filter;
        }
        for ($i=0;$i<$this->getCount();$i++) {
            $result[] = $i;
        }
        return $result;
    }
}