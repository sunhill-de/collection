<?php

namespace Sunhill\Collection\Marketeers\Basic;

use Sunhill\ORM\InfoMarket\Marketeer;
use Sunhill\Collection\Facades\SunhillCache;
use Sunhill\ORM\InfoMarket\Items\DynamicItem;

class PingMarketeer extends CacheReadingMarketeer
{

    protected function initializeMarketeer()
    {
        $entry = explode("\n",$this->readEntry());
        $received = explode(' ',trim(explode(",",$entry[4])[1]))[0];
        
        $this->addEntry('status',(new DynamicItem())->defineValue($received)->type('boolean')->semantic('Status'));
        $answer = explode('icmp_seq=1 ',$entry[1]);
        if ($received == 1) {
            list($ttl_part, $time_part) = explode(' ',trim($answer[1]));
            $ttl = explode('=',$ttl_part)[1];
            $time = explode('=',$time_part)[1];
            $this->addEntry('time',(new DynamicItem())->defineValue($time)->type('float')->semantic('time'));
            $this->addEntry('ttl',(new DynamicItem())->defineValue($ttl)->type('int')->semantic('count'));
            
        } else {
            $this->addEntry('error',(new DynamicItem())->defineValue($answer[1])->type('string')->semantic('name'));
        }
    }
    
}