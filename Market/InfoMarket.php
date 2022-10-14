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
          throw new MarketException(__('Unknown type for installMarketeer.'));
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
  
  protected function wildcardAtomMatches($atom, $test) 
  {
      if (($atom == '*') || ($atom == '?')) {
          return true;
      } else if ($atom == '#') {
          return is_numeric($test);
      } else if ($atom[0] == '*') {
        // leading asterik
        $rest = substr($atom,1);
        if (str_contains($test, '*')) {
            // double asterik
            throw new MarketException(__("Can't handle wildcard ':atom'",['atom'=>$atom]));            
        }
        if (substr($test,-strlen($rest)) != $rest)  {
            return false;
        }
      } else if ($atom[strlen($atom)-1] == '*') {
          // trailing asterik
          $rest = substr($atom,0,-1);
          if (str_contains($test, '*')) {
              // double asterik
              throw new MarketException(__("Can't handle wildcard ':atom'",['atom'=>$atom]));
          }
          if (substr($test,0,strlen($rest)) != $rest) {
              return false;
          }
      } else if (str_contains($atom, '*')){
          // asterik in the middle
          $parts = explode('*',$atom);
          if (count($parts) >= 3) {
              throw new MarketException(__("Can't handle wildcard ':atom'",['atom'=>$atom]));              
          }
          
          $rest = substr($test,-strlen($parts[1]));
          if (substr($test,-strlen($parts[1])) != $parts[1])  {
              return false;
          }
          if (substr($test,0,strlen($parts[0])) != $parts[0]) {
              return false;
          }
      } else {
          throw new MarketException(__("Can't handle wildcard ':atom'",['atom'=>$atom]));          
      }
      return true;
  }
  
  protected function wildcardMatches($needle, $haystack)
  {
     $needle_parts = explode('.', $needle);
     $haystack_parts = explode('.', $haystack);
     for ($i=0;$i<count($needle_parts);$i++) {
         if ($i>=count($haystack_parts)) {
             return false;
         }
         if ($this->containsWildcard($needle_parts[$i])) {
             if (!$this->wildcardAtomMatches($needle_parts[$i],$haystack_parts[$i])) {
                 return false;
             }
         } else {
             if ($haystack_parts[$i] != $needle_parts[$i]) {
                 return false;
             }
         }
     }
     return true;
  }
  
  /**
   * Return alls items that match this wildcard item string $item
   * @param $item string: The string with wildcards
   * @return array: All items that match this wildcard
   */
  protected function solveWildcards(string $item)
  {
    $offerings = $this->getFullOfferings($item);
    $result = [];
    foreach ($offerings as $offering) {
        if ($this->wildcardMatches($item,$offering)){
            $result[] = $offering;
        }
    }
    return $result;
  }
  
  protected function mergeItems(array &$list, string $item)
  {
      if ($this->containsWildcard($item)) {
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
          if (str_contains($list,'{')) {
              $query = json_decode($list,true);
              if (json_last_error() !== JSON_ERROR_NONE) {
                  throw new MarketException(__("Malformed json list request"));
              }
              if (!isset($query['query'])) {
                  throw new MarketException(__("Query doesn't define a query section"));                  
              }
              $list = $query['query'];
          } else if (str_contains($list,'[')) {
              $list = json_decode($list,true);
              if (json_last_error() !== JSON_ERROR_NONE) {
                  throw new MarketException(__("Malformed json list request"));
              }
          } else {
              // query string (a.b.*)  
              $list = [$list];
          }          
      } else if (!is_array($list)) {
            throw new MarketException(__("Malformed list request"));      
      }  
    
      // At this point $list is an array of strings  
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
   *  - object = a StdClass
   */
  public function getItem(string $path, string $credentials = 'anybody', string $format = 'json')
  {
      // First check, if this item is "hardwired"
      if ($result = $this->readHardwiredResult($path)) {
          return $result;
      }
      
      foreach ($this->marketeers as $marketeer) {
          if ($marketeer->offersItem($path)) {
              return $marketeer->getItem($path, $credentials, $format);
          }
      }
      $response = new Response();
      return $response->error(__("The item ':path' doesn't exist.",['path'=>$path]),'ITEMNOTFOUND')->get();
      
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
        $list = $this->createItemList($path);
        $result = [];
        foreach ($list as $entry) {
            $result[$entry] = $this->getItem($entry, $credentials, 'object');
        }
        
        switch ($format) {
            case 'json':
                return json_encode($result);
            case 'object':
                return $result;
            case 'array':
                return json_decode(json_encode($result),true);
        }
  }
  
  public function setItem(string $path, $value, string $credentials = 'anybody')
  {
      foreach ($this->marketeers as $marketeer) {
          if ($marketeer->offersItem($path)) {
              return $marketeer->setItem($path, $value, $credentials);
          }
      }
      $response = new Response();
      return $response->error(__("The item ':path' doesn't exist.",['path'=>$path]),'ITEMNOTFOUND')->get();      
  }
  
  public function setItemList($path, $value, string $credentials = 'anybody')
  {
      $list = $this->createItemList($path);
      foreach ($list as $entry) {
          $result[$entry] = $this->setItem($entry, $value, $credentials);
      }      
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
          throw new MarketException(__("Malformed json request for readItemList."));      
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
          if ($marketeer->offersItem($path)) {
              if ($marketeer->isAccessibleForReading($path, $this->getUser())) {
                  if ($marketeer->isReadable($path)) {
                      if ($result = $marketeer->getItem($path)) {
                          $result->readable();
                          $result->writeable($marketeer->isWriteable($path));
                          $this->fixResponse($result, $path);                      
                          return $result->get();
                      } 
                  } else {
                      $response = new Response();
                      return $response->error(__("The item ':path' is not readable.",['path'=>$path]),'ITEMNOTREADABLE')->get();
                  }
                  
              } else {
                  $response = new Response();
                  return $response->error(__("The item ':path' is not accessible.",['path'=>$path]),'ITEMNOTREADABLE')->get();                  
              }
          }
          
      }
      $response = new Response();
      return $response->error(__("The item ':path' doesn't exist.",['path'=>$path]),'ITEMNOTFOUND')->get();
  }

  protected function getUser() {
      return 'anybody';
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
      return $response->error(__("The item ':path' doesn't exist.",['path'=>$path]),'ITEMNOTFOUND')->get();
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

  /**
   * Returns the offerings that a provides by this market. These offerings can be filtered, limited to a depth and/or 
   * returned as a tree
   * @param string $filter: If there should be a filter for this request (default no filter = "")
   * @param number $depth: Should the result be limited to a depth of subtrees (default no = 0)
   * @param bool $as_tree: Should the result be returned as a tree (default no)
   * @return array
   */
  public function getOfferings(string $filter = '', $depth = 0, bool $as_tree = false): array
  {
        $result = ['infomarket.name','infomarket.version'];
        foreach ($this->marketeers as $marketeer) {
            $offering = $marketeer->getOffer($filter, $depth);
            $result = array_merge($result,$offering);
        }
        
        if (!empty($filter)) {
            $newresult = [];
            foreach ($result as $entry) {
                if ($this->wildcardMatches($filter,$entry)) {
                    $newresult[] = $entry;
                }
            }
            $result = $newresult;
        }
        
        if ($as_tree) {
            return $this->makeTree($result);
        } else {
            return $result;
        }
  }  
  
  public function getFullOfferings(string $filter = '', $depth = 0, bool $as_tree = false): array
  {
      $result = ['infomarket.name','infomarket.version'];
      foreach ($this->marketeers as $marketeer) {
          $offering = $marketeer->getFullOffering($filter, $depth);
          $result = array_merge($result,$offering);
      }

      if (!empty($filter)) {
          $newresult = [];
          foreach ($result as $entry) {
              if ($this->wildcardMatches($filter,$entry)) {
                  $newresult[] = $entry;
              }
          }
          $result = $newresult;
      }
      
      if ($as_tree) {
          return $this->makeTree($result);
      } else {
          return $result;
      }      
  }
  
}
