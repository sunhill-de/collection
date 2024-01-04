<?php

namespace Sunhill\Collection\Tasks;

use Sunhill\Collection\Marketeers\DataSource\CacheDataSource;
use Illuminate\Support\Facades\DB;

class UpdateKnownDevices 
{

    protected function getMacAdress($client)
    {
        $result = ['mac'=>'none','ip'=>'none','manufacturer'=>'none'];
        
        foreach ($client->address as $address) {
            switch ($address->attributes()->addrtype) {
                case 'ipv4':
                    $result['ip'] = $address->attributes()->addr->__toString();
                    break;
                case 'mac':
                    $result['mac'] = $address->attributes()->addr->__toString();                    
                    if (!is_null($address->attributes()->vendor)) {
                        
                        $result['manufacturer'] = $address->attributes()->vendor->__toString()??'none';                        
                    }
                    break;
            }
        }
        
        return $result;
    }
    
    protected function getCurrentClients()
    {
        $result = [];
        $data_source = new CacheDataSource();
        $data_source->setCacheName('macscan.int');
        $list = simplexml_load_string($data_source->getData(), "SimpleXMLElement", LIBXML_NOCDATA);
        foreach ($list->host as $client) {
            $address = $this->getMacAdress($client);
            $result[$address['mac']] = $address;
        }
        return $result;
    }
    
    public function __invoke()
    {
        $current_clients = $this->getCurrentClients();
        foreach ($current_clients as $client => $info) {
            if (DB::table('knownnetworkdevices')->where('mac',$client)->first()) {
                DB::table('knownnetworkdevices')->where('mac', $client)->update(['lastseen'=>now()]);                
            } else {
                DB::table('knownnetworkdevices')->insert(
                    ['name'=>'Unkown device','mac'=>$client,'manufacturer'=>$info['manufacturer'],'last_ip'=>$info['ip'],'firstseen'=>now(),'lastseen'=>now(),'associated_device'=>0]
                    );
            }
       }
    }
}