<?php

namespace Sunhill\InfoMarket\Marketeers\Network;

use Sunhill\InfoMarket\Market\ArrayLeaf;

class MacPingEntryItem extends ArrayLeaf
{

    protected $mac;
    
    protected $ip4;
    
    protected $vendor;
      
    public function __construct($data)
    {
       $this->parseData($data);
    }
  
    protected function parseData($data)
    {
    }
    
    protected function getAllowedFields()
    {
        return ['mac','ip4','vendor'];
    }
    
    protected function getObjectValue(string $name, array $remaining)
    {
        switch ($name) {
            case 'mac': return $this->mac;
            case 'ip4': return $this->ip4;
            case 'vendor': return $this->vendor;
        }        
    }
    
    protected function getObjectMetadata(string $next, array $remaining)
    {
        $result = ['update'=>'asap', 'unit'=>'None','readable'=>true,'writeable'=>false];
        switch ($next) {
            case 'mac':
                $result['type'] = 'Str';
                $result['semantic'] = 'MAC';
                break;
        }
        return $result;
    }
}
