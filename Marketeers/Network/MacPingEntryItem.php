<?php

namespace Sunhill\InfoMarket\Marketeers\Network;

use Sunhill\InfoMarket\Market\ArrayLeaf;

class MacPingEntryItem extends ArrayLeaf
{

    protected $data;
      
    public function __construct($data)
    {
       $this->data = $data;
    }
  
    protected function getAllowedFields()
    {
        return ['mac'];
    }
    
    protected function getObjectValue(string $name, array $remaining)
    {
        return $this->data[$name];
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
