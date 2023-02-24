<?php

namespace Sunhill\InfoMarket\Marketeers\Network;

use Sunhill\InfoMarket\Market\ObjectLeaf;

class MacPingEntryItem extends ObjectLeaf
{

    protected $mac='';
    
    protected $ip4='';
    
    protected $vendor='';
      
    protected $hostname='';
    
    protected $fqdn='';
    
    public function __construct($data)
    {
       $this->parseData($data);
    }
  
    protected function parseData($data)
    {
        foreach ($data->address as $address) {
            if ($address['addrtype'] == 'mac') {
                $this->mac = $address->attributes()->{'addr'}->__toString();
                if (isset($address->attributes()->{'vendor'})) {
                    $this->vendor = $address->attributes()->{'vendor'}->__toString();
                }
            } else if ($address['addrtype'] == 'ipv4') {
                $this->ip4 = $address->attributes()->{'addr'}->__toString();
            }                
        }
        foreach ($data->hostnames as $hostname) {
            if (isset($hostname->{'hostname'})) {
                $host = $hostname->{'hostname'}->attributes()->{'name'};
                if (!is_null($host)) {
                    $this->fqdn = $host->__toString();
                    $this->hostname = explode('.',$this->fqdn)[0];
                }
            }
        }
    }
    
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
