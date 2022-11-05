
<?php

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Market\Element;
use Sunhill\InfoMarket\Market\Marketeer;
use Sunhill\InfoMarket\Market\Market;
use Sunhill\InfoMarket\Market\Item;
use Sunhill\InfoMarket\Response\Response;

class FakeMarketItem extends Item
{
    
    public $value = 5;
    
    protected function getItemValue()
    {
        return $this->value;
    }
    
    protected function setItemValue($value)
    {
        $this->value = $value;
    }
    
}

class FakeMarketItem2 extends Item
{
    
    public $value = 10;
    
    protected function getItemValue()
    {
        return $this->value;
    }

    protected function setItemValue($value)
    {
        $this->value = $value;
    }
        
}

class FakeMarketMarketeer extends Marketeer
{
    
    protected function getOffering(): array
    {
        return [
            'this.is.a.test'=>FakeMarketItem::class,
            'this.is.another.test'=>FakeMarketItem2::class
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
    
    public function testGetMetadata()
    {
        $test = new FakeMarket();
        $test->installMarketeer(FakeMarketMarketeer::class);
        $data = $test->getMetadata('this.is.a.test', 'anybody', 'object');
        
        $this->assertEquals('String',$data->type);
    }
    
    public function testSetItem()
    {
        $test = new FakeMarket();
        $test->installMarketeer(FakeMarketMarketeer::class);
        
        $test->setItem('this.is.a.test',7,'anybody','object');
        $item = $test->getItem('this.is.a.test','anybody','object');
        
        $this->assertEquals(7,$item->value);
    }

    public function testGetItemList()
    {
        $test = new FakeMarket();
        $test->installMarketeer(FakeMarketMarketeer::class);
        
        $data = $test->getItemList(['this.is.a.test','this.is.another.test'],'anybody','object');
        $this->assertEquals(5,$data[0]->value);
    }

    public function testSetItemList()
    {
        $test = new FakeMarket();
        $test->installMarketeer(FakeMarketMarketeer::class);
        
        $data = $test->setItemList(['this.is.a.test','this.is.another.test'],7,'anybody','object');
        $item = $test->getItem('this.is.a.test','anybody','object');
        $this->assertEquals(7,$item->value);
    }
    
}