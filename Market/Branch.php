<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\InfoMarketException;

/**
 * Class for a simple branch of the info market tree
 * @author klaus
 *
 */
class Branch extends Element
{
    
    protected $subbranches = [];

    protected $read_restriction = 'anybody';

    public function setReadRestriction(string $restriction): Branch
    {
        $this->read_restriction = $restriction;
        return $this;
    }
    
    public function getReadRestriction(): string
    {
        return $this->read_restriction;    
    }
    
    /**
     * Tests if this branch already has a subbranch with the name $name
     * @param string $name
     * @return bool true if the branch already exists otherwise false
     */
    public function hasSubbranch(string $name): bool
    {
        return isset($this->subbranches[$name]); 
    }
    
    /**
     * Adds a subbranch with the name $name (if it not already exists) and return the
     * given branch
     * @param string $name
     * @return Branch
     */
    public function addSubbranch(string $name): Branch
    {
        if (!$this->hasSubbranch($name)) {
            $branch = new Branch();
            $branch->setName($name);
            $branch->setOwner($this);
            $this->subbranches[$name] = $branch;
        }
        
        return $this->subbranches[$name];
    }
    
    /**
     * Returns the subbranch if it exists otherwise false
     * @param string $name
     * @return Element
     */
    public function getSubbranch(string $name)
    {
        if ($this->hasSubbranch($name)) {
            return $this->subbranches[$name];
        } else {
            return false;
        }
    }
    
    /**
     * There is no more routing information, so this must be a (pseudo)leaf so insert it as such
     * @param string $name
     * @param Element $item
     * @throws InfoMarketException
     */
    protected function processItem(string $name, Element $item)
    {
        $item->setOwner($this);
        $item->setName($name);
        if ($this->hasSubbranch($name)) {
            throw new InfoMarketException(__("The item :item already exists.", ['item'=>$name]));
        }
        $this->subbranches[$name] = $item;
    }
    
    /**
     * Inserts the given Item with the given routing informations into the subbranches
     * @param string $first
     * @param array $remain
     * @param Element $item
     */
    public function processThisOffer(string $first, array $remain, Element $item)
    {
        if (empty($remain)) {
            $this->processItem($first, $item);
        } else {
            $branch = $this->addSubbranch($first);
            $first = array_shift($remain);
            $branch->processThisOffer($first, $remain, $item);
        }
    }
    
    /**
     * Checks if a subbranch exists, 
     *   if yes check if there is more routing information 
     *      if yes route deeper 
     *      if no return this     
     *   if no return false
     * {@inheritDoc}
     * @see \Sunhill\InfoMarket\Market\Element::getThisElement($next, $remains)
     */
    protected function getThisElement(string $first, array $remain)
    {
        if (!($subbranch = $this->getSubbranch($first))) {
            // Subbranch doesn't exists
            return false;            
        }
        if (empty($remain)) {
            // There is no more information so return this subbranch
            $result = new \StdClass();
            $result->element = $subbranch;
            $result->remains = [];
            return $result;
        }
        // Routing goes deeper
        $first = array_shift($remain);
        return $subbranch->getElement($first, $remain);
    }
    
    protected function getThisMetadata(Response &$response, array $remains = [])
    {
        $response->OK()->semantic('Branch')->unit('None')->Type('Branch')->setElement('readable', true)
                ->setElement('writeable',true)->setElement('read_restriction',$this->getReadRestriction());
        return true;
    } 
    
    protected function collectThisNodes(string $credentials): array
    {
        $result = [];
        foreach ($this->subbranches as $name => $branch) {
            $response = new Response();
            $branch->getMetadata($response);
            if ($this->checkRestriction($response->getElement('read_restriction'),$credentials)) {
                $result[] = $name;       
            }
        }
        return $result;
    }    
}
