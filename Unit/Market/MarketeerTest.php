<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Item;
use Sunhill\InfoMarket\Market\Marketeer;
use Sunhill\InfoMarket\Response\Response;

class MarketeerFakeItem extends Item
{
    protected function doGetItemValue(Response &$response, array $remains = [])
    {
        return 5;
    }
}

class FakeMarketeer extends Marketeer
{
    protected function getOffering(): array
    {
        return [
            'this.is.a.test'=>MarketeerFakeItem::class,
            'this.is.another.test'=>MarketeerFakeItem::class,
            'and.this.a.complete.different'=>MarketeerFakeItem::class,
        ];
    }
}

class MarketeerTest extends SunhillNoAppTestCase
{
    
    public function testGetOffering()
    {
        $test = new FakeMarketeer();
        $response = new Response();
        $response->setElement('method','get');
        $test->route(['this','is','a','test'],'anybody',$response);
        $this->assertEquals(5,$response->get('object')->value);
    }
    
    public function testGetOffer()
    {
        $test = new FakeMarketeer();
        $result = $test->getOffer();
        sort($result);
        $this->assertEquals(['and.this.a.complete.different','this.is.a.test','this.is.another.test'],$result);
    }
    
    public function testGetRootOffering()
    {
        $test = new FakeMarketeer();
        $result = $test->getRootOffering();
        sort($result);
        $this->assertEquals(['and','this'],$result);
    }
    
}