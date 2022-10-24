<?php

namespace Sunhill\InfoMarket\Market;

abstract class Marketeer extends Branch
{
    
    abstract protected function getOffering(): array;
    
    public function __construct()
    {
        parent::__construct();
        $this->processOfferings();
    }
    
    protected function processOfferings()
    {
        foreach ($this->getOffering() as $path => $item) {
            $parts = explode('.',$path);
            $this->processOffering($this, $parts, $item);       
        }            
    }
    
    protected function processOffering(Branch $branch, array $parts, string $item)
    {
        if (count($parts) > 1) {
            $first = array_shift($parts);
            $this->processOffering($this->searchOrAddBranch($branch, $first), $parts, $item);
        } else {
            $class = new $item();
            $class->setName($parts[0]);
            $branch->addSubbranch($class);
        }
    }
    
    protected function searchOrAddBranch(Branch $branch, string $item)
    {
        if ($branch->hasSubbranch($item)) {
            return $branch->getSubbranch($item);
        } else {
            $subbranch = new Branch();
            $subbranch->setName($item);
            $branch->addSubbranch($subbranch);
            return $subbranch;
        }
    }
 
    /**
     * Returns only the first part of each branch. This method is used by the market to start routing
     * @return array of strings the first part of each branch
     */
    public function getRootOffering(): array
    {
        $result = [];
        foreach ($this->subbranches as $subbranch => $item) {
            $result[] = $subbranch;
        }
        return $result;
    }
}