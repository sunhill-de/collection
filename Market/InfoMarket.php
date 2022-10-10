<?php
/**
 * @file InfoMarket.php
 * Provides the InfoMarket core class
 * Lang en
 * Reviewstatus: 2021-10-26
 * Localization: none
 * Documentation: complete
 * Tests: 
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Marketeers\MarketeerBase;
use Sunhill\InfoMarket\Market\MarketException;
use Sunhill\InfoMarket\Marketeers\Response\Response;

define('CURRENT_VERSION','0.1');

/**
 * The core class of this project. It's exports the following methods:
 * - installMarketeer - To install a new marketeer. This mustn't be exported via a REST-API (local only)
 * - getItem - To retrieve all informations (metadatas) of this item
 * - getItemList - To retrieve all informations (metadatas) of a list of items
 * - readItem - To read only the value of an item
 * - readItemList - To read only the values of a list of items
 * - writeItem - To write the value to an item
 * - writeItemList - To write the value to a list of items
 * - getOfferings - To collect all offerings from all marketeers
 */
class InfoMarket
{
  
  /**
   * Stores the installed marketeers
   */
  protected $marketeers = [];  
   
  /**
   * Installs a new marketeer that is reachable by this InfoMarket.
   * @param string|MarketeerBase $class if $class is a string than it is resolved to a marketeer 
   * class, if $class is a MarketeerBasse object than this object is inserted
   */
  public function installMarketeer($class)
  {
      if (is_string($class)) {
          $class = new $class();
      }
      if (is_a($class,MarketeerBase::class)) {
          $this->marketeers[] = $class;           
      } else {
          throw new MarketException('Unknown type for installMarketeer.');
      }
  }

  /**
   * Checks if a given string contains a wildcard (*, # or ?)
   * @param $test string: The string to test
   * @returns bool: True, if $test contains a wildcard otheriwse false
   */
  protected function containsWildcard(string $test): bool
  {
      return (str_contains($test,'*') || str_contains($test,'#') || str_contains($test,'?'));
  }
  
  /**
   * Return alls items that match this wildcard item string $item
   * @param $item string: The string with wildcards
   * @return array: All items that match this wildcard
   */
  protected function solveWildcards(string $item)
  {
  }
  
  protected function mergeItems(array &$list, string $item)
  {
      if (containsWildcard($item)) {
        $list = array_merge($list, $this->solveWildcards($item));
      } else {
        // Trivial, just append
        $list[] = $item;
      }
  }
  
  /**
   * Depending of $list this function returns an array of strings where each string represents a wanted item
   * @param $list array|string The wanted items
   * @returns array of strings
   */
  protected function createItemList($list): array
  {
      if (is_string($list)) {
        $info = json_decode($list,true); 
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new MarketException(__("Malformed json list request"));      
        }
        
        $list = $info['query'];
      }  
      if (!is_array($list)) {
            throw new MarketException(__("Malformed list request"));      
      }  
    
      $result = [];
      foreach ($list as $entry) {
        $this->mergeItems($result, $entry);
      }  
      return $result;
  }
  
  /**
   * Return all avaiable informations (=metadatas) of this item
   * @param $path string: The path to the item
   * @param $credentials string: The current user (default anybody)
   * @params $format string: In what format should the values be returned
   * @returns dependig on $format:
   *  - json  = a json encoded string
   *  - array = a php array
   */
  public function getItem(string $path, string $credentials = 'anybody', string $format = 'json')
  {
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
  
  /**
   * Reads a single item given by $path and returns the json answer
   * @param string $path The path to the information
   * @param $credentials The 
   * @return string returns the answer of the first marketeer that offers one
   */
  public function readItem(string $path, string $credentials = 'anybody'): string
  {
      return $this->readSingleItem($path,$credentials);
  }

  /**
   * Reads a list of items given by a json array in $list and return the answer for this
   * items as a json result
   * @param string $list
   * @return string
   */
  public function readItemList(string $list, $credentials = null): string
  {
      $info = json_decode($list,true); 
    
      if (json_last_error() !== JSON_ERROR_NONE) {
          throw new MarketException('Malformed json request for readItemList.');      
      }
      
      $result = ['result'=>[]];
    
      foreach ($info['query'] as $query) {
         $result['result'][] = json_decode($this->readSingleItem($query,$credentials));
      }
      return json_encode($result);
  }
  
  protected function readSingleItem(string $path, $credentials): string
  {
      if ($result = $this->readHardwiredResult($path)) {
        return $result;
      }
      foreach ($this->marketeers as $marketeer) {
          if ($result = $marketeer->getItem($path)) {
              $this->fixResponse($result, $path);   
              return $result->get();
          }
      }
      $response = new Response();
      return $response->error("The item '$path' was not found.",'ITEMNOTFOUND')->get();
  }

  protected function fixResponse(Response &$response, string $path)
  {
        $response->request($path);    
  }
  
  /**
   * Hardwired informations are informations that are not routet through a marketeer but answered directly. Mostly for testing purposes
   * @param $path string: The requested path
   * @return string|bool Either the json result (if found) or false (if not found)
   */
  protected function readHardwiredResult(string $path)
  {
    switch ($path) {
      case 'infomarket.name':
          return (new Response())->OK()->request($path)->type('String')->unit(' ')->value('InfoMarket')->get();
      case 'infomarket.version':
          return (new Response())->OK()->request($path)->type('String')->unit(' ')->value(CURRENT_VERSION)->get();
    }
    return false;
  }
  
  /**
   * Writes the value $value to the item identified by $path and returns, if the action was successful
   * @param $path
   * @param $value
   * @param $credentials
   * @returns string 
   */
  public function writeItem(string $path, $value, $credentials = null): string
  {
      foreach ($this->marketeers as $marketeer) {
          if ($result = $marketeer->setItem($path, $value)) {
              $this->fixResponse($result, $path);   
              return $result->get();
          }
      }
      $response = new Response();
      return $response->error("The item '$path' was not found.",'ITEMNOTFOUND')->get();
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
  
  public function getOfferings(bool $as_tree = false): array
  {
        $result = [];
        foreach ($this->marketeers as $marketeer) {
            $offering = $marketeer->getOffer();
            $result = array_merge($result,$offering);
        }
        if ($as_tree) {
            return $this->makeTree($result);
        } else {
            return $result;
        }
  }  
  
  public function getFullOfferings(bool $as_tree = false): array
  {
      $result = [];
      foreach ($this->marketeers as $marketeer) {
          $offering = $marketeer->getFullOffer();
          $result = array_merge($result,$offering);
      }
      if ($as_tree) {
          return $this->makeTree($result);
      } else {
          return $result;
      }      
  }
  
}
