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

    protected function processOffer(string $offer, $item)
    {
        $parts = explode('.', $offer);
        $first = array_shift($parts);
        
        if (is_string($item)) {
            $item = new $item();
        }
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
     * Depending on $format convert the input into the desired output format
     * @param $input array|StdClass The input data
     * @return string|array|StdClass The processed (or not processed) input
     */
    protected function processFormat($input, string $format)
    {
        switch ($format) {
            case 'object': return $input;
            case 'json' : return json_encode($input);
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
        return $this->processFormat($result, $format);
    }
    
    public function setItemList($path, $value, string $credentials = 'anybody', string $format = 'json')
    {
        $result = [];
        $list = $this->parseList($path);
        foreach ($list as $entry) {
            $result[] = $this->setItem($entry, $value, $credentials, 'object');
        }
        return $this->processFormat($result, $format);
    }

    protected function fillMetadata(string $path, bool $read_value, string $credentials = 'anybody')
    {
        $result = new Response();
        $result->setElement('request', $path);
        if ($element = $this->getElement($path)) {
            $element->element->getMetadata($result, $element->remains);
            if ($element->element->isAllowedToRead($credentials, $element->remains) || !$result->getElement('readable')) {
                if ($read_value && $result->getElement('readable')) {
                    $result->value($element->element->getValue($element->remains));
                }    
            } else {
                $result->error('ITEMNOTALLOWEDTOREAD',"The current user is not allowed to read this item");            
            }    
        } else {
            $result->error('ITEMNOTFOUND',"The item was not found");
        }
        return $result;
    }
    
    /**
     * Gets only the metadata (not the value), checks if the current user is allowed to read and returns it in the desired format
     */
    public function getItemMetadata(string $path, string $credentials = 'anybody', string $format = 'json')
    {
        $result = $this->fillMetadata($path, false, $credentials);
        return $result->get($format);
    }
    
    /**
     * gets the value and metadata of the given item $path, checks the access rights and returns it in the wanted format
     * @param $path string: The dot separated path to the item (or branch)
     * @param $credentials string: The current credentials of the user
     * @param $format string ('json', 'object', 'array') The desired output format
     */
    public function getItem(string $path, string $credentials = 'anybody', string $format = 'json')
    {
        $result = $this->fillMetadata($path, true, $credentials);
        return $result->get($format);
    }
   
    /**
     * gets the value and metadata of the given item $path, checks the access rights and sets the value
     * @param $path string: The dot separated path to the item (or branch)
     * @param $value : The value to set
     * @param $credentials string: The current credentials of the user
     * @param $format string ('json', 'object', 'array') The desired output format
     */
    public function setItem(string $path, $value, string $credentials = 'anybody', string $format = 'json')
    {
        $result = $this->fillMetadata($path, true, $credentials);
        if ($element = $this->getElement($path)) {
            if ($element->element->isAllowedToWrite($credentials, $element->remains)) {
                $element->element->setValue($value, $element->remains);
            } else {
                $result->error("ITEMNOTALLOWEDTOWRITE","The current user is not allowed to write this item");
            }    
        }        
        return $result->get($format);
    }
    
    /**
     * Returns the complete offer of all installed marketeers
     */
    public function getOffer(bool $flat = true, string $format = 'array')
    {
        
    }
    
    /**
     * Collect all nodes from the branch $parent and return it converted to $format
     */
    public function getNodes(string $parent, string $format = 'object', string $credentials = 'anybody')
    {
        if (($parent == "") || ($parent == "#")) {
            $result = $this->collectNodes($credentials);
        } else {
            $element = $this->getElement($parent);
            $result = $element->element->collectNodes($credentials);               
        } 
        return $this->processFormat($result, $format);
    }    
}
