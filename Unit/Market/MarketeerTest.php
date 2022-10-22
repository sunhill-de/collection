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
            'this.is.a.test'=>MarketeerFakeItem::class
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
        $this->assertEquals(['this.is.a.test'],$test->getOffer());
    }
}