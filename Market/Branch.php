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
     * Adjusts the abstract method for branches. That means, if there is a subbranch with the searched name
     * and there are remaining routing call this method of the subbranch, if there is no remaining routing
     * return the subbranch. if there is no subbranch return null
     * @param string $next
     * @param array $remains
     * @return \StdClass|unknown|NULL
     * Test test\Unit\Market\BranchTest::testGetElementPass, test\Unit\Market\BranchTest::testGetElementPass2
     */
    protected function getThisElement(string $next, array $remains)
    {
        if ($this->hasSubbranch($next)) {
            $branch = $this->getSubbranch($next);
            if (empty($remains)) {
                $result = new \StdClass();
                $result->element = $branch;
                $result->remains = $remains;
                return $result;
            } else {
                $next = array_shift($remains);
                return $branch->getElement($next, $remains);
            }
        } else {
            return null;
        }
    }
    
    protected function getThisMetadata(Response &$response, array $remains = [] )
    {
        if (!empty($remains)) {
            return false; // A branch mustn't have a getMetadata-request with remains
        }
        $response
        ->OK()
        ->setElement('readable',true)
        ->setElement('writeable',false)
        ->unit(' ')
        ->semantic('branch')
        ->type('Branch')
        ->update('late')
        ->setElement('read_restriction','anybody');
        return true;
    }
    
    /**
     * Gets the value of this element or null if there is no value
     * @param Response $response
     * @param array $remains
     */
    protected function getThisValue(array $remains = [])
    {
        return null;   
    }
    
    /**
     * Sets the value of this element or ignores the request if it's not possible to set a value
     * @param unknown $value
     * @param array $remains
     */
    protected function setThisValue($value, array $remains = [])
    {
        // Ignore request
    }
    
    /**
     * Returns if the current user is allowed to read this element
     * @param string $credentials
     * @param array $remains
     * @return bool
     */
    protected function isThisAllowedToRead(string $credentials, array $remains = []): bool
    {
        if (!empty($remains)) {
            return false; // A branch mustn't have a getMetadata-request with remains
        }
        return true; // At the moment all branches are readable
    }
    
    protected function isThisAllowedToWrite(string $credentials, array $remains = []): bool
    {
        return false; // Branches are not writeable
    }
    
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
    
    /**
     * Branch implementation of getThisOffer
     * @param int $depth
     * @return array
     * test /tests/Unit/Market/BranchTest::testGetOffer()
     */
    protected function getThisOffer(int $depth)
    {
        if ($depth == 0) { // Respect $depth
            return [];
        }
        $result = [];
        foreach ($this->subbranches as $subbranch) {
            $suboffer = $subbranch->getOffer($depth-1);
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