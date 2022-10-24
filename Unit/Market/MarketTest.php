<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Market\Marketeer;
use Sunhill\InfoMarket\Market\Market;
use Sunhill\InfoMarket\Market\Item;
use Sunhill\InfoMarket\Response\Response;

class FakeMarketItem extends Item
{
    
    protected function doGetItemValue(Response &$response, array $remains = [])
    {
        return 5;
    }
    
}

class FakeMarketMarketeer extends Marketeer
{
    
    protected function getOffering(): array
    {
        return [
            'this.is.a.test'=>FakeMarketItem::class
        ];
    }
    
}

class FakeMarket extends Market
{
    
}

class MarketTest extends SunhillNoAppTestCase
{
    
    public function testInstallMarketer()
    {
        $test = new FakeMarket();
        $test->installMarketeer(FakeMarketMarketeer::class);
        $item = $test->getItem('this.is.a.test','anybody','object');
        
        $this->assertEquals(5,$item->value);
    }
    
}