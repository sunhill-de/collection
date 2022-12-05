<?php

namespace Sunhill\InfoMarket\Tests\Feature;

use Sunhill\Basic\Tests\SunhillAppTestCase;
use Sunhill\InfoMarket\Facades\InfoMarket;

class SimpleTest extends SunhillAppTestCase
{
        
    public function testSimpleString()
    {
        $item = InfoMarket::getItem('infomarket.name','anybody','object');
        $this->assertEquals('InfoMarket',$item->value);
        $this->assertEquals('Str',$item->type);
        $this->assertEquals('Name',$item->semantic);
        $this->assertEquals('None',$item->unit);
        $this->assertFalse($item->writeable);
        $this->assertEquals('infomarket.name',$item->request);
    }
    
    public function testSimpleArrayCount()
    {
        $item = InfoMarket::getItem('infomarket.types.count','anybody','object');
        $this->assertEquals(10,$item->value);
    }
    
    public function testSimpleArrayElement()
    {
        $item = InfoMarket::getItem('infomarket.types.0','anybody','object');
        $this->assertEquals('Arrayfield',$item->value);
    }
    
    public function testSimpleArrayOrder()
    {
        $item = InfoMarket::getItem('infomarket.types.by_reverse.0','anybody','object');
        $this->assertEquals('Time',$item->value);        
    }
}