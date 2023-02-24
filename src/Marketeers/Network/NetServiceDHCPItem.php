<?php

namespace Sunhill\InfoMarket\Marketeers\Network;

use Sunhill\InfoMarket\Market\ArrayLeaf;

class NetServiceDHCPItem extends ArrayLeaf
{
    
    protected $online;
  
    protected $server;
  
    protected $offer;
  
    protected function getAllowedFields()
    {
        return ['online','server','offer'];
    }
    
    protected function getObjectValue(string $name, array $remaining)
    {
        return $this->$name;  
    }
    
    protected function getObjectMetadata(string $next, array $remaining)
    {
        $result = ['update'=>'asap', 'unit'=>'None','readable'=>true,'writeable'=>false];
        switch ($next) {
            case 'online':
                $result['type'] = 'Boolean';
                $result['semantic'] = 'Online';
                break;
          case 'server':
                $result['type'] = 'Str';
                $result['semantic'] = 'IP4';
                break;
          case 'offer':
                $result['type'] = 'Str';
                $result['semantic'] = 'IP4';
                break;
        }
        return $result;
    }
}
