<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\InfoMarketException;
use Sunhill\InfoMarket\Marketeers\Internal\InternalMarketeer;

class Market extends Branch
{

    /**
     * Stores the marketeers
     * @var array
     */
    protected $marketeers = [];
    
    /**
     * Checks if $class is already a marketeer object (then just return it)
     * Then if $class is a string and a existing class, create an object an return it
     * @param String|Marketeer $class
     * @throws InfoMarketException
     * @return Marketeer
     */
    protected function getMarketeer($class): Marketeer
    {
        if (is_string($class) && class_exists($class)) {
            $class = new $class();
        } 
        if (is_a($class,Marketeer::class)) {
            return $class;
        }
        throw new InfoMarketException(__("Can't process marketeer"));        
    }

    protected function processOffer(string $offer, Element $item)
    {
        $parts = explode('.', $offer);
        $first = array_shift($offer);
        
        $this->processThisOffer($first, $parts, $item);
    }
    
    /**
     * Adds the marketeer 
     * @param Marketeer $marketeer
     */
    protected function addMarketeer(Marketeer $marketeer)
    {
        $this->marketeers[] = $marketeer;
        $total_offer = $marketeer->getOffer();
        foreach ($total_offer as $offer => $item) {
            $this->processOffer($offer, $item);
        }
    }
    
    /**
     * Installs a new marketeer that is reachable by this InfoMarket.
     * @param string|MarketeerBase $class if $class is a string than it is resolved to a marketeer
     * class, if $class is a Marketeer object than this object is inserted
     */
    public function installMarketeer($class)
    {
        $this->addMarketeer($this->getMarketeer($class));
    }

    /**
     * Setup the default marketeer (the one every market should offer)
     */
    public function setupMarketeers()
    {
        $this->installMarketeer(InternalMarketeer::class);
    }
    
    /**
     * Adds an alias for another item to this market
     * @param unknown $target
     */
    public function addAlias(string $target, string $alias)
    {
        $aliasItem = new AliasItem($target);
        $this->processOffer($alias, $aliasItem);
    }
    
    /**
     * Parses the given list of request to an array
     * @param unknown $list
     * @return array
     */
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
        
}