<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\Visual\Marketeers\StatusMarketeer;

class TestStatus extends StatusMarketeer 
{
    
    protected function getStatus(): bool
    {
        return true;
    }
    
}