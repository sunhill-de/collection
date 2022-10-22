<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\InfoMarket\Marketeers\MarketeerBase;
use Sunhill\InfoMarket\Items\ArrayItemBase;
use Sunhill\InfoMarket\Market\InfoMarket;
use Sunhill\Basic\Tests\SunhillAppTestCase;

class ArrayItem extends ArrayItemBase
{
    
    protected function getArrayCount()
    {
        return 3;
    }
    
    protected function getArrayItemByIndex(int $index)
    {
        return $index * 2;    
    }
    
}

class TestArrayMarketeer extends MarketeerBase
{
    
    protected function getOffering(): array
    {
        return [
            'test.item'=>ArrayItem::class,
        ];
    }
    
}

class InfoMarketArrayTest extends SunhillAppTestCase
{

    protected function getMarket()
    {
        $test = new InfoMarket();
        $test->installMarketeer(TestArrayMarketeer::class);
        return $test;
    }
    
    public function testReadArrayItemCount()
    {
        $test = $this->getMarket();
        $this->assertEquals(3,$test->getItem('test.item.count','anybody','object')->value);
    }
    
    public function testReadArrayItemIndex()
    {
        $test = $this->getMarket();
        $this->assertEquals(10,$test->getItem('test.item.2','anybody','object')->value);        
    }
        
}
