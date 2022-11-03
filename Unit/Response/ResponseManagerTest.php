<?php

namespace Sunhill\InfoMarket\Tests\Unit\Response;

use Sunhill\Basic\Tests\SunhillNoAppTestCase;
use Sunhill\InfoMarket\Facades\InfoMarket;

class ResponseManagerTest extends SunhillNoAppTestCase
{
    
    public function testSomething()
    {
        InfoMarket::installMarketeer("A");        
    }
    
}