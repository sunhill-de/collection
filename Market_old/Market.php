<?php

namespace Sunhill\InfoMarket\Market;

use Sunhill\Basic\Loggable;
use Sunhill\InfoMarket\Response\Response;
use Sunhill\InfoMarket\InfoMarketException;
use Sunhill\InfoMarket\Marketeers\Internal\InternalMarketeer;

class Market extends Loggable
{
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
    
    protected function getRootNodes()
    {
        $result = [];

        foreach ($this->branch_starts as $start => $marketeers) {
            $entry = new \StdClass();
            $entry->name = $start;
            $entry->semantic = 'Branch';
            $result[] = $entry;
        }    
        foreach ($this->alias as $alias) {
            $parts = explode('.',$alias);
            $first = array_shift($parts);
            if (!in_array($first, $result)) {
                   $result[] = $first;
            }    
        }     
        return $result;
    }

    protected function getItemNode($element)
    {
        $result = [];
        $offer = $element->element->getDeepOffer();
         foreach ($offer as $single) {
            $entry = new \StdClass();
            $entry->name = $single;
            $entry->semantic = 'Leaf';
            $result[] = $entry;
         }    
        return $result;
    }
    
    protected function getNonRootNodes(string $parent, string $credentials)
    {
            $parts = explode('.',$parent);
            $first = array_shift($parts);
            if (($element = $this->getElement($first, $parts)) && is_a($element->element, Leaf::class)) {
                return $this->getItemNode($element);
            }
            // We have a branch
            $total_offer = [];
            foreach ($this->branch_starts[$first] as $marketeer) {
                $total_offer = array_merge($total_offer, $marketeer->getOffer());
            }
            $total_offer = array_merge($total_offer, $this->alias); // Merge in the aliases
            $result = [];
            foreach ($total_offer as $offer) {
                if (strpos($offer,$parent) === 0) {
                    $element = $this->getItem($offer,$credentials,"object");
                    $entry = new \StdClass();
                    $offer = substr($offer,strlen($parent)+1); // Remove the leading part
                    $parts = explode('.',$offer);
                    $first = array_shift($parts);
                    $entry->name = $first;
                    if ($element->semantic == 'Branch') {
                        $entry->semantic = 'Branch';
                    } else {
                        $entry->semantic = 'Leaf';
                    }
                    if (!array_key_exists($first, $result)) {
                        $result[$first] = $entry;
                    }    
                } 
            }
        
            return array_values($result);
    }
    
    public function getNodes(string $parent, string $format = 'object', string $credentials = 'anybody')
    {
        if (($parent == "") || ($parent == "#")) {
            $result = $this->getRootNodes($credentials);
        }  else {
            $result = $this->getNonRootNodes($parent,$credentials);
        }
        switch ($format) {
            case 'object': return $result;
            case 'json': return json_encode($result);
        }
    }
    
}
