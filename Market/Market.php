<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\Basic\Loggable;
use Sunhill\InfoMarket\Response\Response;

class Market extends Loggable
{
    
    /**
     * key => array of marketeer
     * @var array
     */
    protected $branch_starts = [];
    
    /**
     * Takes all branch beginnings from the given marketeer $class and sorts them into $branch_starts
     * @param Marketeer $class
     */
    protected function collectRootOffering(Marketeer $class)
    {
        $parts = $class->getRootOffering();
        foreach ($parts as $part) {
            if (isset($this->branch_starts[$part])) {
                $this->branch_starts[$part][] = $class;
            } else {
                $this->branch_starts[$part] = [$class];                
            }
        }        
    }
    
    /**
     * Installs a new marketeer that is reachable by this InfoMarket.
     * @param string|MarketeerBase $class if $class is a string than it is resolved to a marketeer
     * class, if $class is a Marketeer object than this object is inserted
     */    
    public function installMarketeer($class)
    {
        if (is_string($class) && class_exists($class)) {
            $class = new $class();
        } else if (!is_a($class,Marketeer::class)) {
            throw new InfoMarketException(__("Can't process marketeer."));
        }
        
        $this->collectRootOffering($class);
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

    public function setItemList($path, $value, string $credentials = 'anybody')
    {
        
    }
    
    protected function getElement(string $first, array $remain)
    {
        if (!isset($this->branch_starts[$first])) {
            return false;
        }
        if (empty($remain)) {
            // We are searching for root element
            $result = new \StdClass();
            $result->element = $this->branch_starts[$first];
            $result->remains = $remain; 
            return $result;
        } else {
            foreach ($this->branch_starts[$first] as $marketeer) {
                if ($result = $marketeer->getElement($first, $remain)) {
                    return $result;
                }
            }
            return false;
        }
    }
    
    /**
     * Return the best fitting element or null if there is none
     * @param string $path
     */
    protected function route(string $path)
    {
        $parts = explode('.',$path);
        $first = array_shift($parts);
        
        return $this->getElement($first, $parts);
    }
    
    /**
     * Return all avaiable informations (=metadatas) and the current value of this item
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
        if ($element = $this->route($path)) {
            if ($element->element->isAllowedToRead($credentials, $element->remains)) {
                $result = new Response();
                $result->setElement('request',$path);
                $element->element->getItem($result, $element->remains);
                return $result->get($format);
            }
        } else {
            $result = new Response();
            $result->error('ITEMNOTFOUND',"The item was not found");
            return $result->get($format);
        }
    }
    
    public function setItem(string $path, $value, string $credentials = 'anybody')
    {
        if ($element = $this->route($path)) {
            if ($element->element->isAllowedToWrite($credentials, $element->remains)) {
                $result = new Response();
                $result->setElement('request',$path);
                $element->element->setItem($value,$result, $element->remains);
                return $result->get($format);
            }
        } else {
            $result = new Response();
            $result->error('ITEMNOTFOUND',"The item was not found");
            return $result->get($format);
        }
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
    public function getMetadata(string $path, string $credentials = 'anybody', string $format = 'json')
    {
        if ($element = $this->route($path)) {
            if ($element->element->isAllowedToRead($credentials, $parts)) {
                $result = new Response();
                $result->setElement('request',$path);
                $element->element->getThisMetadata($result, $element->remains);
                return $result->get($format);
            }
        } else {
            $result = new Response();
            $result->error('ITEMNOTFOUND',"The item was not found");
            return $result->get($format);
        }
    }
}