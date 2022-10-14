<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\InfoMarket\Test\InfoMarketTestCase;
use Sunhill\InfoMarket\Market\InfoMarket;
use Sunhill\InfoMarket\Market\MarketException;
use Sunhill\InfoMarket\Marketeers\MarketeerBase;
use Sunhill\InfoMarket\Items\ItemBase;

class TestItem1 extends ItemBase
{

    protected static $value = 5;
    
    protected function getMetadata()
    {
        return [
            'writeable'=>true
        ];
    }
    
    protected function getItemValue()
    {
        return static::$value;
    }
    
    protected function setItemValue($value)
    {
        static::$value = $value;
    }
}

class TestItem2 extends ItemBase
{
 
    protected static $value = 5;
    
    protected $param;
    
    protected function getMetadata()
    {
        return [
            'writeable'=>true
        ];    
    }
    
    protected function getItemValue()
    {
        return static::$value * $this->param;
    }
    
    protected function setItemValue($value)
    {
        static::$value = $value;
    }
    
    public function setParams($params)
    {
        $this->param = $params[0];    
    }
    
    public function getPermutations() 
    {
        return [[1],[2]];    
    }
}

class TestMarketeer1 extends MarketeerBase
{
    
    protected function getOffering(): array
    {
        return [
            'test.item'=>TestItem1::class,
            'indexed.#.test'=>TestItem2::class,
        ];    
    }
    
}

class TestItem3 extends ItemBase
{
    protected $value = 'Test';
    
    protected function getItemValue()
    {
        return $this->value;
    }
    
    protected function setItemValue($value)
    {
        $this->value = $value;
    }
    
}

class TestItem4 extends ItemBase
{
    protected $param1;
    
    protected $param2;
    
    protected function getItemValue()
    {
        return $this->param1.'+'.$this->param2;
    }
        
    public function setParams($params)
    {
        $this->param1 = $params[0];
        $this->param2 = $params[1];
    }
    
    public function getPermutations()
    {
        return [['ab','cd'],['ab','ef'],['bc','cd'],['bc','ef']];
    }
}

class TestMarketeer2 extends MarketeerBase
{

    protected function getOffering(): array
    {
        return [
            'test.another'=>TestItem3::class,
            'some.?.test.?'=>TestItem4::class
            ];
    }
}

class InfoMarketBase extends InfoMarketTestCase
{

    protected function getMarket()
    {
        $test = new InfoMarket();
        $test->installMarketeer(TestMarketeer1::class);
        $test->installMarketeer(TestMarketeer2::class);
        return $test;
    }
        
}
