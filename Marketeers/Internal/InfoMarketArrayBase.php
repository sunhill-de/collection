<?php

namespace Sunhill\InfoMarket\Marketeers\Internal;

use Sunhill\InfoMarket\Market\ArrayLeaf;

abstract class InfoMarketArrayBase extends ArrayLeaf
{
    protected $metadata = [
        'unit'=>'',
        'type'=>'Str',
        'semantic'=>'Name'
    ];  

    protected $cache;
  
    abstract function getBaseDir();
  
    abstract function classFits(string $test);
      
    protected function readClasses()
    {
      $base = $this->getBaseDir();
      $d = dir($base);
      while (false !== ($entry = $d->read())) {
          if (is_file($base.'/'.$entry)) {
            require_once($base.'/'.$entry);
          }
      }
      $d->close();
    }
  
    protected function addClasses()
    {
        foreach (get_declared_classes() as $class) {
            if ($this->classFits($class)) {
              $this->cache[] = $this->splitClassName($class);
            }
        }
    }

    protected function splitClassName(string $class)
    {
      $list = explode("\\",$class);
      return array_pop($list);
    }
  
    protected function fillCache()
    {
        if (!is_null($this->cache)) {
          return;
        } 
        $this->readClasses();
        $this->addClasses();
    }
  
    protected function getCount(string $filter): int
    {
        $this->fillCache();
        return count($this->cache);
    }

    protected function getIndexValue(int $index, array $remains, string $order, string $filter)
    {
        $this->fillCache();
        $result = [];
        switch ($filter) {
            case 'begins':
                foreach ($this->cache as $entry) {
                    if (substr($entry,0,strlen($remains[0])) == $remains[0]) {
                        $result[] = $entry;
                    }
                }
            default:
                $result = $this->cache;
        }
        switch ($order) {
            case 'reverse':
                $result = array_reverse($result);            
        }
        return $result[$index];
    }  
  
    protected function getAllowedSort(): array
    {
        return ['reverse'];
    }
    
    protected function getAllowedFilter(): array
    {
        return ['begins','contains'];
    }
    
}  
