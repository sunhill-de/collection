<?php

namespace Sunhill\InfoMarket\Test\Marketeers;

use Sunhill\InfoMarket\Marketeers\MarketeerBase;
use Sunhill\InfoMarket\Marketeers\Response\Response;

class FakeMarketeer3 extends MarketeerBase
{

    protected $value = 5;
  
    protected function getOffering(): array
    {
        return [
            'readable.byreadable'=>'byreadable',
            'readable.byget'=>'byget',
            'writeable.bywriteable'=>'bywriteable',
            'writeable.byset'=>'byset',
        ];
    }

    protected function byreadable_readable()
    {
        return true;
    }
  
    protected function get_byreadable()
    {
        return $value;
    }
  
    protected function get_byget()
    {
        return $value;
    }
  
    protected function bywriteable_writeable()
    {
        return true;
    }
  
    protected function set_byset($value)
    {
        $this->value = $value;
    }  
  
    protected function set_bywriteable($value)
    {
        $this->value = $value; 
    }  
}

