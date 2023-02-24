<?php

namespace Sunhill\InfoMarket\Marketeers\Home;

use Sunhill\InfoMarket\Market\ObjectLeaf;

class OpenHabEntryItem extends ObjectLeaf
{

    protected function getAllowedFields()
    {
        return ['mac','ip4','vendor','fqdn','hostname'];
    }
    
    protected function getObjectValue(string $name, array $remaining)
    {
        return $this->$name;
    }
    
    protected function getObjectMetadata(string $next, array $remaining)
    {
        $result = ['type'=>'Str','update'=>'asap', 'unit'=>'None','readable'=>true,'writeable'=>false];
        switch ($next) {
            case 'mac':
                $result['semantic'] = 'Mac';
                break;
            case 'ip4':
                $result['semantic'] = 'Ip4';
                break;
            default:
                $result['semantic'] = 'Name';
        }
        return $result;
    }
}
