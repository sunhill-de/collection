
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

class FakeMarketMarketeer2 extends Marketeer
{

    protected function getOffering(): array
    {
        return [
            'here.is.another.route'=>FakeMarketItem::class,
            'here.is.even.another.route'=>FakeMarketItem2::class
        ];
    }
    
}

class FakeMarket extends Market
{
    
}

class MarketTest extends SunhillNoAppTestCase
{
    
    protected function getMarket()
    {
        $test = new FakeMarket();
        $test->installMarketeer(FakeMarketMarketeer::class);
        $test->installMarketeer(FakeMarketMarketeer2::class);   
        return $test;
    }
    
    public function testGetItemObject()
    {
        $test = $this->getMarket();

        $item = $test->getItem('this.is.a.test','anybody','object');
        
        $this->assertEquals(5,$item->value);
    }
    
    public function testGetItemJson()
    {
        $test = $this->getMarket();
        
        $item = json_decode($test->getItem('this.is.a.test','anybody','json'),false);
        
        $this->assertEquals(5,$item->value);
    }
    
    public function testGetItemMissing()
    {
        $test = $this->getMarket();
        
        $item = $test->getItem('does.not.exist','anybody','object');
        
        $this->assertEquals('FAILED',$item->result);        
    }
    
    public function testGetMetadata()
    {
        $test = $this->getMarket();
        
        $data = $test->getMetadata('this.is.a.test', 'anybody', 'object');
        
        $this->assertEquals('Str',$data->type);
    }
    
    public function testSetItem()
    {
        $test = $this->getMarket();
        
        $test->setItem('this.is.a.test',7,'anybody','object');
        $item = $test->getItem('this.is.a.test','anybody','object');
        
        $this->assertEquals(7,$item->value);
    }

    public function testGetItemList()
    {
        $test = $this->getMarket();
                
        $data = $test->getItemList(['this.is.a.test','this.is.another.test'],'anybody','object');
        $this->assertEquals(5,$data[0]->value);
    }

    public function testSetItemList()
    {
        $test = $this->getMarket();
        
        $data = $test->setItemList(['this.is.a.test','this.is.another.test'],7,'anybody','object');
        $item = $test->getItem('this.is.a.test','anybody','object');
        $this->assertEquals(7,$item->value);
    }
    
    public function testGetOfferFlat()
    {
        $test = $this->getMarket();
        
        $list = $test->getOffer(true,'array');
        sort($list);
        $this->assertEquals(
            [
                'here.is.another.route',
                'here.is.even.another.route',
                'this.is.a.test',
                'this.is.another.test'],$list);
    }
    
    public function testGetOfferTree()
    {
        $test = $this->getMarket();
        
        $list = $test->getOffer(false,'array');
        $this->assertTrue(array_key_exists('here',$list));
        $this->assertTrue(isset($list['here']['entries']));
    }
}