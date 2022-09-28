<?php

namespace Sunhill\InfoMarket\Test\Marketeers;

use Sunhill\InfoMarket\Marketeers\MarketeerBase;
use Sunhill\InfoMarket\Marketeers\Response\Response;

class FakeMarketeer3 extends MarketeerBase
{

    public $value = 5;
  
    protected function getOffering(): array
    {
        return [
            'readable.byreadable'=>'byreadable',
            'readable.byget'=>'byget',
            'writeable.bywriteable'=>'bywriteable',
            'writeable.byset'=>'byset',
            'readwrite.bywriteable'=>'rwbywriteable',
            'readwrite.byset'=>'rwbyset'
        ];
    }

    protected function byreadable_readable()
    {
        return true;
    }
  
    protected function get_byreadable()
    {
        $response = new Response();
        return $response->OK()->unit(' ')->type('Integer')->value($this->value);
    }
  
    protected function get_byget()
    {
        $response = new Response();
        return $response->OK()->unit(' ')->type('Integer')->value($this->value);
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

    protected function set_rwbyset($value)
    {
        $this->value = $value;
    }
    
    protected function set_rwbywriteable($value)
    {
        $this->value = $value;
    }

    protected function get_rwbywriteable()
    {
        $response = new Response();
        return $response->OK()->unit(' ')->type('Integer')->value($this->value);
    }
    
    protected function get_rwbyset()
    {
        $response = new Response();
        return $response->OK()->unit(' ')->type('Integer')->value($this->value);
    }
    
    
}

