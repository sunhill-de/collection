<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\Basic\Loggable;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\InfoMarketException;
use Sunhill\InfoMarket\Marketeers\Internal\InternalMarketeer;

class Market extends Loggable
{
    
    /**
     * Stores the marketeers
     * @var array
     */
    protected $marketeers = [];
    
    /**
     * key => array of marketeer
     * @var array
     */
    protected $branch_starts = [];
    
    /**
     * Stores the alias marketeer if there is one
     * @var unknown
     */
    protected $alias = [];
    
    protected function alreadyInList(string $start, $class)
    {
        if (!isset($this->branch_starts[$start])) {
            return false;
        }
        foreach ($this->branch_starts[$start] as $test) {
            if ($test == $class) {
                return true;
            }
        }
        return false;
    }
    
    protected function setBranchStart($start, $class) 
    {
        if ($this->alreadyInList($start, $class)) {
            return; // nothing to do
        }
        
        if (isset($this->branch_starts[$start])) {
            $this->branch_starts[$start][] = $class;
        } else {
            $this->branch_starts[$start] = [$class];
        }        
    }
    
    /**
     * Takes all branch beginnings from the given marketeer $class and sorts them into $branch_starts
     * @param Marketeer $class
     */
    protected function collectRootOffering(Marketeer $class)
    {
        $parts = $class->getRootOffering();
        foreach ($parts as $part) {
            $this->setBranchStart($part, $class);
        }        
    }
    
    public function setupMarketeers()
    {
        $this->installMarketeer(InternalMarketeer::class);
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
        $this->marketeers[] = $class;
        $this->collectRootOffering($class);
    }
    
    /**
     * Adds an alias for another item to this market
     * @param unknown $target
     */
    public function addAlias(string $target, string $alias)
    {
        $this->alias[$alias] = $target;
    }
    
    protected function parseList($list): array
    {
        if (is_array($list)) {
            return $list;
        } else if (is_string($list)) {
            $list = json_decode($list,true);
        }
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
        $result = [];
        $list = $this->parseList($path);
        foreach ($list as $entry) {
            $result[] = $this->getItem($entry, $credentials, 'object');    
        }
        switch ($format) {
            case 'object': return $result;
            case 'json' : return json_encode($result);
        }
    }

    public function setItemList($path, $value, string $credentials = 'anybody', string $format = 'json')
    {
        $result = [];
        $list = $this->parseList($path);
        foreach ($list as $entry) {
            $result[] = $this->setItem($entry, $value, $credentials, 'object');
        }
        switch ($format) {
            case 'object': return $result;
            case 'json' : return json_encode($result);            
        }
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
    
    protected function translateAlias(string $path)
    {
        foreach ($this->alias as $alias => $target) {
            if (substr($path,0,strlen($alias)) == $alias) {
                return $target.substr($path,strlen($alias));
            }
        }
        return $path;
    }
    
    /**
     * Return the best fitting element or null if there is none
     * @param string $path
     */
    protected function route(string $path)
    {
        $path = $this->translateAlias($path);
        
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
                $element->element->getMetadata($result, $element->remains);
                $result->value($element->element->getValue($element->remains));
                return $result->get($format);
            }
        } else {
            $result = new Response();
            $result->error('ITEMNOTFOUND',"The item was not found");
            return $result->get($format);
        }
    }
    
    public function setItem(string $path, $value, string $credentials = 'anybody', string $format = 'json')
    {
        if ($element = $this->route($path)) {
            if ($element->element->isAllowedToWrite($credentials, $element->remains)) {
                $result = new Response();
                $result->setElement('request',$path);
                $element->element->getMetadata($result, $element->remains);
                $element->element->setValue($value, $element->remains);
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
            if ($element->element->isAllowedToRead($credentials, $element->remains)) {
                $result = new Response();
                $result->setElement('request',$path);
                $element->element->getMetadata($result, $element->remains);
                return $result->get($format);
            }
        } else {
            $result = new Response();
            $result->error('ITEMNOTFOUND',"The item was not found");
            return $result->get($format);
        }
    }
    
    protected function addEntryToTree(string $entry, $path, &$tree) {
        if (empty($entry)) {
            return;
        }
        $parts = explode('.',$entry);
        $first = array_shift($parts);
        $remain = implode('.',$parts);
        if (!isset($tree[$first])) {
            $tree[$first] = ['name'=>$first,'entries'=>[],'path'=>($remain == "")?$path:null];
        }
        $this->addEntryToTree($remain,$path,$tree[$first]['entries']);
    }
    
    protected function makeTree(array $input): array
    {
        $result = [];
        foreach ($input as $entry) {
            $this->addEntryToTree($entry, $entry, $result);
        }
        return $result;
    }
    
    public function getOffer(bool $flat = true, string $format = 'array')
    {
        $result = array_keys($this->alias);
        
        foreach ($this->marketeers as $marketeer) {
            $offer = $marketeer->getOffer();
            $result = array_merge($result,$offer);
        }
        if (!$flat) {
            $result = $this->makeTree($result);
        }
        switch ($format) {
            case 'array': return $result;
            case 'json': return json_encode($result);
        }
    }
    
}