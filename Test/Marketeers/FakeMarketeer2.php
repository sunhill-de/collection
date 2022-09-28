<?php

namespace Sunhill\InfoMarket\Test\Marketeers;

use Sunhill\InfoMarket\Marketeers\MarketeerBase;
use Sunhill\InfoMarket\Marketeers\Response\Response;

class FakeMarketeer2 extends MarketeerBase
{

    protected function getOffering(): array
    {
        return [
            'fake2.test'=>'Fake2Test',
            'test.array.nonsense'=>'NonsenseTest'
        ];
    }
    
    protected function itemIsReadable(string $name, $variables): bool
    {
        return true;        
    }
    
    protected function itemIsWriteable(string $name, $variables): bool
    {
        return false;    
    }
    
    protected function get_Fake2Test(): Response
    {
        $response = new Response();
        return $response->OK()->unit(' ')->type('String')->value('ABC');        
    }
    
    protected function get_NonsenseTest(): Response
    {
        $response = new Response();
        return $response->OK()->unit(' ')->type('String')->value('NONSENSE');
    }
    
}


