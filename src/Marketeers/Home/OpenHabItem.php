<?php

namespace Sunhill\Collection\Marketeers\Home;

use Sunhill\InfoMarket\Market\ObjectLeaf;

class OpenHabItem extends ArrayLeaf
{
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
