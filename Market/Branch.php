<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\Market\Branch;

/**
 * Class for a simple branch of the info market tree
 * @author klaus
 *
 */
class Branch extends Element
{
    
    protected $subbranches = [];

    /**
     * Returns, if the subbranch already exists
     * @param string $name
     * @return bool
     */
    public function hasSubbranch(string $name): bool
    {
        return isset($this->subbranches[$name]);    
    }

    /**
     * Adds a new subbranch to this branch (if it not already exists)
     * @param Element $branch
     * @return \Sunhill\InfoMarket\Market\Branch
     */
    public function addSubbranch(Element $branch)
    {
        $name = $branch->getName();
        $branch->setOwner($this);
        if (!isset($this->subbranches[$name])) {
            $this->subbranches[$name] = $branch;
        } else {
            if (is_a($branch,Branch::class)) {                
                $branch->mergeSubbranch($name,$this->subbranches[$name]);
            } else {
                throw new InfoMarketException(__("An item with the name ':name' already exists",['name'=>$name]));
            }
        }
        return $this;
    }
    
    /**
     * Whenever the parent branch already has a subbranch with the name $name it has to be merged with this
     * @param string $name
     * @param Branch $branch
     * Test: Unit/Market/BranchTest::testMergeBranch()
     */
    public function mergeSubbranch(string $name, Branch $branch)
    {
        foreach ($this->subbranches as $subbranch) {
            $branch->addSubbranch($subbranch);
        }
    }
    
    /**
     * Returns the subbranch if it exists otherwise false
     * @param string $name
     * @return Element
     */
    public function getSubbranch(string $name): Element
    {
        if ($this->hasSubbranch($name)) {
            return $this->subbranches[$name];
        } else {
            return false;
        }
    }
    
    protected function doRoute(string $element, array $remains, string $credentials, Response &$response)
    {
        if (isset($this->subbranches[$element])) {
            return $this->subbranches[$element]->route($remains,$credentials,$response);
        } else {
            return false;
        }
    }
 
    protected function routeFinished(string $credentials, Response &$response)
    {
    }
    
    protected function doGetOffer(string $credentials, string $filter, int $depth)
    {
        if ($depth == 0) { // Respect $depth
            return [];
        }
        $result = [];
        foreach ($this->subbranches as $subbranch) {
            $suboffer = $subbranch->getOffer($credentials,$filter,$depth-1);
            if (!empty($this->name)) {
             for ($i=0;$i<count($suboffer);$i++) {
                 $suboffer[$i] = $this->getName().'.'.$suboffer[$i];
             }
            }
            $result = array_merge($result,$suboffer);
        }
        return $result;
    }
    
}