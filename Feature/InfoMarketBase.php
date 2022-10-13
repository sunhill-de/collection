<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\InfoMarket\Test\InfoMarketTestCase;
use Sunhill\InfoMarket\Market\InfoMarket;
use Sunhill\InfoMarket\Market\MarketException;
use Sunhill\InfoMarket\Marketeers\MarketeerBase;
use Sunhill\InfoMarket\Items\ItemBase;

class TestItem1 extends ItemBase
{

    protected $value = 5;
    
    protected function getItemValue()
    {
        return $this->value;
    }
    
}

class TestItem2 extends ItemBase
{
 
    protected $value = 5;
    
    protected $param;
    
    protected function getMetadata()
    {
        return [
            'writeable'=>true
        ];    
    }
    
    protected function getItemValue()
    {
        return $this->value * $this->param;
    }
    
    protected function setItemValue($value)
    {
        $this->value = $value;
    }
    
    public function setParams($param)
    {
        $this->param = $param;    
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
    protected function getItemValue()
    {
        return 'Test';
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
        
    public function setParams($param1,$param2)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
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
