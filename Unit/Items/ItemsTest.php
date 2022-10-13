<?php

namespace Sunhill\InfoMarket\Tests\Unit\Market;

use Sunhill\InfoMarket\Test\InfoMarketTestCase;
use Sunhill\InfoMarket\Marketeers\MarketeerBase;
use Sunhill\InfoMarket\Market\InfoMarket;
use Sunhill\InfoMarket\Market\MarketException;
use Sunhill\InfoMarket\Test\Marketeers\FakeMarketeer;
use Sunhill\InfoMarket\Test\Marketeers\FakeMarketeer2;
use Sunhill\InfoMarket\Marketeers\Response\Response;
use Sunhill\InfoMarket\Items\ItemBase;

class SimpleTestItem extends ItemBase
{
 
    protected $value = 5;
    
    protected function getItemValue()
    {
        return $this->value;    
    }

    protected function setItemValue($value)
    {
        $this->value = $value;    
    }
    
}

class ComplexTestItem extends ItemBase
{
    
    protected function getMetadata()
    {
        return [
            'unit'=>'C',
            'semantic'=>'temp'
        ];    
    }
    
    protected $value = 5;
    
    protected function getItemValue()
    {
        return $this->value;
    }
    
    protected function setItemValue($value)
    {
        $this->value = $value;
    }
    
}

class ItemsTest extends InfoMarketTestCase
{

    /**
     * @dataProvider ValueProvider
     * @param unknown $item
     * @param unknown $param
     * @param unknown $expect
     */
    public function testValues($item,$param,$expect)
    {
        $test = new $item();
        $this->assertEquals($expect,$test->buildMetadata()->getElement($param));
    }
    
    public function ValueProvider()
    {
        return [
            [SimpleTestItem::class,'read_restriction','anybody'],
            [SimpleTestItem::class,'value',5],
            [SimpleTestItem::class,'human_readable_value','5'],
            [SimpleTestItem::class,'unit',''],
            [SimpleTestItem::class,'semantic','Name'],
            [SimpleTestItem::class,'type','String'],
            [ComplexTestItem::class,'read_restriction','anybody'],
            [ComplexTestItem::class,'value',5],
            [ComplexTestItem::class,'human_readable_value','5 °C'],
            [ComplexTestItem::class,'unit','°C'],
            [ComplexTestItem::class,'semantic','Temperature'],
            [ComplexTestItem::class,'type','String'],
        ];
    }
    
    public function testSetValue()
    {
        $test = new SimpleTestItem();
        $test->setValue(6);
        $this->assertEquals(6,$test->getValue('raw'));
    }
}
