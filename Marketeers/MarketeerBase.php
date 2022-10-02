<?php
/**
 * @file InfoElement.php
 * Provides the base class for InfoElements
 * Lang en
 * Reviewstatus: 2021-10-30
 * Localization: none
 * Documentation: complete
 * Tests: Unit/Marketeers/MarketeersTest.php
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 * @todo: Merging results? 
 * 
 */

namespace Sunhill\InfoMarket\Marketeers;

use Sunhill\InfoMarket\Marketeers\MarketeerException;
use Sunhill\InfoMarket\Marketeers\Response\Response;
use Illuminate\Support\Facades\Cache;

abstract class MarketeerBase
{
    
    /**
     * Returns an array of items that this Marketeer offers. The result is a associative array:
     * - The key defines the offered path
     * - The value defines the base name of the callback. That means
     *     if the marketeer defines a method get + the base name -> This is the getter for the item
     *     if the marketeer defines a methode base name + _readable -> this is a method that returns if the item is readable
     *     if the marketeer defines a methode base name + _writeable -> this is a method that returns if the item is writeable
     *     if the marketeer defines a methode base name + _restrictions -> this is a method that returns possible restrictions 
     * @return unknown
     */
    public function getOffer(): array
    {
        return array_keys($this->getOffering());    
    }
    
    /**
     * Returns an array of string that name every avaiable item that this marketeer offers
     * @return array
     */
    abstract protected function getOffering(): array;
    
    /**
     * Returns (if possible) all offered items including the wildcard ones
     * @return array
     */
    public function getFullOffering(): array
    {
        $offering = $this->getOffering();
        $result = [];
        foreach ($offering as $key => $value) {
            if (str_contains($key,'*') || str_contains($key,'?') || str_contains($key,'#')) {
               $method_name = 'solve_'.$value;
               if (method_exists($this,$method_name)) {
                    $sub_offering = $this->$method_name();
                    $result = array_merge($result,$sub_offering);
               } else {
                   $result[$key] = $value;
               }
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }
    
    public function getFullOffer(): array
    {
        return array_keys($this->getFullOffering());    
    }
    
    /**
     * Raises an exception if $test contains *, # or ?
     */
    private function checkAllowedChars(string $name)
    {
        if (strpos($name,'*')) {
            throw new MarketeerException(__("An item query mustn't contain :symbol :name",['symbol'=>'*','name'=>$name]));
        }
        if (strpos($name,'#')) {
            throw new MarketeerException(__("An item query mustn't contain :symbol :name",['symbol'=>'#','name'=>$name]));
        }
        if (strpos($name,'?')) {
            throw new MarketeerException(__("An item query mustn't contain :symbol :name",['symbol'=>'?','name'=>$name]));
        }        
    }
    
    /**
     * Tests if the string $search matches to the string $offer.
     * @param $search string: The string to search for. Mustn't contain *, # or ?
     * @param $offer string: The string that offers a possible match
     * @param &$variables null|array: If not null the matches of #,? and * fields are stored here
     * @return bool: True, if the offer matches the search, otherwise false
     */
    private function offerMatches(string $search,string $offer,&$variables=null): bool
    {
        if (!is_null($variables) && !is_array($variables)) {
            $variables = [];
        }
        $search_parts = explode('.',$search);
        $offer_parts = explode('.',$offer);
        
        $i = 0;
        while (true) {
            if (($i == count($search_parts)) && ($i == count($offer_parts))) {
                // At this point the search matches the offer
                return true;
            }
            if (($i == count($search_parts)) || ($i == count($offer_parts))) {
                // At this point either search or offer is shorter, so the offer doesn't match
                if (!is_null($variables)) {
                    $variables = [];
                }
                return false;
            }
            switch ($offer_parts[$i]) {
                case '#':
                    if (!is_numeric($search_parts[$i])) {
                        // If it is not numeric it doesn't match 
                        if (!is_null($variables)) {
                            $variables = [];
                        }
                        return false;
                    }
                    // otherwise treat it like a '?'
                case '?':
                    if (!is_null($variables)) {
                        $variables[] = $search_parts[$i];
                    }
                    break;
                case '*':
                    if (!is_null($variables)) {
                        $temp = [];
                        for ($j = $i; $j < count($search_parts); $j++) {
                            $temp[] = $search_parts[$j];
                        }
                        $variables[] = implode('.',$temp);
                    }    
                    return true;
                    break;
                default:
                    if ($search_parts[$i] != $offer_parts[$i]) {
                        if (!is_null($variables)) {
                            $variables = [];
                        }
                        return false;
                    }
            }
            $i++;
        }    
    }

    /**
     * Checks if the marketeer offers the given item
     * @param string $name The item to search for
     * @return bool, True if the marketeer offers this item otherwise false
     */
    public function offersItem(string $name): bool
    {
        $this->checkAllowedChars($name);

        foreach ($this->getOffering() as $offer=>$callback) {
            if ($this->offerMatches($name,$offer)) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * If the given item is offered then it returns the name of the item-method otherwise false
     * @param $name string: The item to search for
     * @returns false|string see above
     */
    protected function getItemBase(string $name, &$variables = null)
    {
        $this->checkAllowedChars($name);

        foreach ($this->getOffering() as $offer=>$callback) {
            if ($this->offerMatches($name,$offer,$variables)) {
                return $callback;
            }
        }
        return false;    
    }
    
    /**
     * If the given item is offered then it returns the name of the item-method otherwise false
     * @param $name string: The item to search for
     * @returns false|string see above
     */
    protected function getItemMethod(string $name, string $prefix = '', 
                                     string $postfix = '', &$variables=null)
    {
        if ($result = $this->getItemBase($name,$variables)) {
            return $prefix.$result.$postfix;
        } else {
            return false;
        }
    }
    
    /**
     * Used to check, if the given item has some restrictions. It returns an associative
     * array with the field 'read' and 'write' with an associated usergroup. By default
     * this group is 'anybody' which means that anybody can access this information. 
     * @param string $name
     * @throws MarketeerException
     * @return string
     */
    public function getRestrictions(string $name): array
    {
        $variables = [];
        if ($base = $this->getItemBase($name, $variables)) {
            return $this->getItemRestrictions($base, $variables);
        } else {
            throw new MarketeerException(__("The item ':name' doesn't exists.",['name'=>$name]));
        }
    }
    
    /**
     * This method look for a method that is names 'item-method'_restrictions. if found returns its value
     * otherwise return the default restrictions
     * @param string $name
     * @return array
     */
    protected function getItemRestrictions(string $base, $variables = null): array
    {
        $method = $base.'_restrictions';
        if (method_exists($this,$method)) {
            return $this->$method($variables);
        } else {
            return $this->getDefaultRestrictions();
        }
    }
    
    protected function getDefaultRestrictions(): array
    {
        return ['read'=>'anybody','write'=>'anybody'];     
    }
    
    /**
     * Returns if the given item is readable or raises an exception if it doesn't exist
     * @param string $name
     * @throws MarketeerException
     * @return bool
     */
    public function isReadable(string $name): bool
    {
        $variables = [];
        if ($base = $this->getItemBase($name, $variables)) {
            return $this->itemIsReadable($base, $variables);
        } else {
            throw new MarketeerException(__("The item ':name' doesn't exists.",['name'=>$name]));
        }
    }

    protected function itemIsReadable(string $base, $variables): bool
    {
        $method = $base.'_readable';
        if (method_exists($this,$method)) {
            return $this->$method($variables);
        } else {
            $method = 'get_'.$base;
            if (method_exists($this,$method)) {
                return true;
            } else {
                return false; 
            }
        }
    }
    
    /**
     * Returns if the given item is writeable or raises an exception if it doesn't exist
     * @param string $name
     * @throws MarketeerException
     * @return bool
     */
    public function isWriteable(string $name, $credentials = null): bool
    {
        $variables = [];
        if ($base = $this->getItemBase($name, $variables)) {
            return $this->itemIsWriteable($base, $variables);
        } else {
            throw new MarketeerException(__("The item ':name' doesn't exists.",['name'=>$name]));
        }        
    }

    protected function itemIsWriteable(string $base, $variables): bool
    {
        $method = $base.'_writeable';
        if (method_exists($this,$method)) {
            return $this->$method($variables);
        } else {
            $method = 'set_'.$base;
            if (method_exists($this,$method)) {
                return true;
            } else {
                return false; // Default not writeable
            }
        }        
    }
    
    /**
     * Checks if the given user is on the same or higer level as the given restriction
     * @param unknown $user
     * @param unknown $restriction
     * @throws MarketeerException
     * @return bool
     */
    protected function isAccessible($user,$restriction): bool
    {
        switch ($restriction) {
            case 'anybody':
                return true;
            case 'user':
                return in_array($user,['user','advanced','admin']);
            case 'advanced':
                return in_array($user,['advanced','admin']);
            case 'admin':
                return $user == 'admin';
            default:
                throw new MarketeerException(__("Unkown user group ':restriction'",['restriction'=>$restriction]));
        }
    }

    protected function getUpdate(string $interval)
    {
        switch ($interval) {
            case 'ASAP': return 5; break;
            case 'Minute': return 60; break;
            case 'Hour': return 3600; break;
            case 'Day': return 3600*24; break;
            case 'Late': return  3600*24; break;
            default: return $interval;
        }        
    }
        
    protected function retrieveItem(string $method, string $name, $variables)
    {                                        
        if (Cache::has($name)) {
            return Cache::get($name);
        } else {    
            // @todo implement caching
            $method = 'get_'.$method;
            if (method_exists($this,$method)) {
                $value = $this->$method(...$variables);
                
                if ($value->hasElement('update')) {
                    $update = $this->getUpdate($value->getElement('update'));
                } else {
                    $update = 5;
                }
                Cache::put($name, $value, $update);
                return $value;
            } else {
                throw new MarketeerException(__("Item ':name' is marked as readable but has no get_ method.",array('name'=>$name)));
            }            
        }   
    }
    
    /**
     * Checks if the item exists, is accessible and readable. If yes the item is returned
     * @param string $name
     * @param string $user
     * @return boolean|\Sunhill\InfoMarket\Marketeers\Response\Response false if not found otherwise response
     */
    public function getItem(string $name,$user = 'anybody')
    {
        $variables = [];
        $method = $this->getItemBase($name,$variables);
        
        if ($method === false) {
            return false;
        } else {
            $restrictions = $this->getItemRestrictions($method, $variables);
            if (!$this->isAccessible($user,$restrictions['read'])) {
                $response = new Response();
                return $response->error(__("The item ':name' is not accessible",['name'=>$name]),'ITEMNOTACCESSIBLE');
            }
            if (!$this->itemIsReadable($method, $variables)) {
                $response = new Response();
                return $response->error(__("The item ':name' is not readable",['name'=>$name]),'ITEMNOTREADABLE');                
            }
            return $this->retrieveItem($method,$name,$variables);
        }                
    }
    
    protected function changeItem(string $base, string $name, $value, $variables)
    {
            $method = 'set_'.$base;
            if (method_exists($this,$method)) {
                $update = 5;
                if ($this->isReadable($name)) {
                    $current = $this->getItem($name);
                    if ($current->hasElement('update')) {
                        $update = $this->getUpdate($current->getElement('update'));
                    } 
                    $current->value($value);
                    Cache::put($name, $current, $update);
                } 
                if (is_array($variables)) {
                    array_push($variables,$value);
                } else {
                    $variables = [$value];
                }
                return $this->$method(...$variables);
            } else {
                throw new MarketeerException(__("Item ':name' is marked as writeable but has no set_ method.",array('name'=>$name)));
            }    
    }
    
    /**
     * Tries to write $value to the item $name
     */
    public function setItem(string $name, $value, $user = 'anybody')
    {
        $variables = [];
        $method = $this->getItemBase($name,$variables);
        
        if ($method === false) {
            return false;
        } else {
            $restrictions = $this->getItemRestrictions($method, $variables);
            if (!$this->isAccessible($user,$restrictions['write'])) {
                $response = new Response();
                return $response->error(__("The item ':name' is not accessible",['name'=>$name]),'ITEMNOTACCESSIBLE');
            }
            if (!$this->itemIsWriteable($method, $variables)) {
                $response = new Response();
                return $response->error(__("The item ':name' is not writeable",['name'=>$name]),'ITEMNOTWRITEABLE');                
            }
            return $this->changeItem($method, $name, $value, $variables);
        }                        
    }
    
}
