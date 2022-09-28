<?php

namespace Sunhill\InfoMarket\Tests\Unit\Marketeers;

use Sunhill\InfoMarket\Test\InfoMarketTestCase;
use Sunhill\InfoMarket\Test\Marketeers\FakeMarketeer3;

class ReadWriteTest extends InfoMarketTestCase
{

    /**
     * @dataProvider ReadProvider
     * @param unknown $test
     * @param unknown $offer
     * @param unknown $expect
     */
    public function testRead($test,$isreadable,$value)
    {
        $test_obj = new FakeMarketeer3();
        $this->assertEquals($isreadable,$test_obj->isReadable($test));
        if ($isreadable) {
          $this->assertEquals($value,$test_obj->getItem($test)->getElement('value'));
        }
    }
    
    public function ReadProvider()
    {
        return [
          ['readable.byreadable',true,5],
          ['readable.byget',true,5],
          ['writeable.byset',false,null],
        ];
    }
  
    /**
     * @dataProvider WriteProvider
     * @param unknown $test
     * @param unknown $offer
     * @param unknown $expect
     */
    public function testWrite($test,$iswriteable,$value)
    {
        $test_obj = new FakeMarketeer3();
        $this->assertEquals($iswriteable,$test_obj->isWriteable($test));
        if ($iswriteable) {
          $test_obj->setItem($test,$value);
          $this->assertEquals($value,$test_obj->getItem($test)->getElement('value'));
        }
    }
    
    public function WriteProvider()
    {
      return [    
          ['writeable.bywriteable',true,7],
          ['writeable.byset',true,7],
          ['readable.byget',false,null],
        ];
    }
    
}
