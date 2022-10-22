<?php

namespace Sunhill\InfoMarket\Market;

class Market extends Marketeer
{
    
    /**
     * Installs a new marketeer that is reachable by this InfoMarket.
     * @param string|MarketeerBase $class if $class is a string than it is resolved to a marketeer
     * class, if $class is a Marketeer object than this object is inserted
     */    
    public function installMarketeer($class)
    {
        
    }
    
    /**
     * Return all avaiable informations (=metadatas) of this item
     * @param $path string: The path to the item
     * @param $credentials string: The current user (default anybody)
     * @params $format string: In what format should the values be returned
     * @returns dependig on $format:
     *  - json  = a json encoded string
     *  - array = a php array
     *  - object = a StdClass
     */    
    public function getItem(string $path, string $credentials = 'anybody', string $format = 'json') 
    {
        $response = new Response();
        $response->setElement('request',$path);
        $response->setElement('parameters',[]);
        
        $parts = explode('.',$path);
        
        if ($this->route($parts,$credentials,$response)) {
            $response->OK();
        } else {
            $response->error(__("The item ':path' doesn't exist.",['path'=>$path]),'ITEMNOTFOUND');            
        }
        return $response->get($format);
    }
    
    /**
     * Return all avaiable informations (=metadatas) of this item
     * @param $path: A list of the wanted items.
     *  - if $path is a string then it's treated as a json encoded list
     *  - if $path is an array then it's treated as an array of strings
     * @param $credentials string: The current user (default anybody)
     * @params $format string: In what format should the values be returned
     * @returns dependig on $format:
     *  - json  = a json encoded string
     *  - array = a php array
     */
    public function getItemList($path, string $credentials = 'anybody', string $format = 'json')
    {
        
    }

    public function setItem(string $path, $value, string $credentials = 'anybody')
    {
        
    }
    
    public function setItemList($path, $value, string $credentials = 'anybody')
    {
        
    }
        
}