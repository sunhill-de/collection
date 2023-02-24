<?php

namespace Sunhill\Collection\Marketeers\Network;

use Sunhill\InfoMarket\Market\ArrayLeaf;

class MacPingItem extends ArrayLeaf
{
    protected $element_metadata = [
        'unit'=>'',
        'type'=>'Str',
        'semantic'=>'Branch'
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
    
    protected function getCount(string $filter): int
    {
        $this->fillCache();
        return count($this->cache->host);
    }
    
    protected function getIndexValue(int $index, array $remains, string $order, string $filter)
    {
        $this->fillCache();
        return new MacPingEntryItem($this->cache->host[$index]);
    }
    
}
