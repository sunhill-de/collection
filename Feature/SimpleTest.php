<?php

namespace Sunhill\InfoMarket\Tests\Feature;

class SimpleTest extends MarketBase
{
    
    public function testSimpleRouting()
    {
        $test = $this->getMarket();
        
        $item = $test->getItem('simple.test.item','anybody','object');
        $this->assertEquals('TeSt',$item->value);
        
        $item = $test->getItem('simple.test.entry','anybody','object');
        $this->assertEquals('tEsT',$item->value);
        
        $item = $test->getItem('simple.test.entry2','anybody','object');        
        $this->assertEquals('TesT',$item->value);
    }
    
    /**
     * @dataProvider GetMetadataProvider
     * @param unknown $path
     * @param unknown $data
     * @param unknown $expect
     */
    public function testGetMetadata($path, $data, $expect)
    {
        
    }
    
    public function GetMetadataProvider()
    {
        return [
            ['simple.test','type','Branch']
        ];
    }
}