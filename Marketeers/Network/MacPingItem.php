<?php

namespace Sunhill\InfoMarket\Marketeers\Network;

use Sunhill\InfoMarket\Market\ArrayLeaf;

class MacPingItem extends ArrayLeaf
{
    protected $metadata = [
        'unit'=>'',
        'type'=>'Str',
        'semantic'=>'Name'
    ];
    
    protected $cache;
    
    protected function getLastScan()
    {
        return dirname(__FILE__).'/../../../tests/files/MacPing';    
    }
    
    protected function fillCache()
    {
   //     libxml_use_internal_errors(true);
        $this->cache = simplexml_load_file($this->getLastScan());
    }
    
    protected function getCount(): int
    {
        $this->fillCache();
        return count($this->cache->host);
    }
    
    protected function getIndexValue(int $index, array $remains)
    {
        $this->fillCache();
    }
    
}
