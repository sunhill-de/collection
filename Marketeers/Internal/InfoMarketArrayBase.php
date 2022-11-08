<?php

namespace Sunhill\InfoMarket\Marketeers\Internal;

use Sunhill\InfoMarket\Market\ArrayLeaf;

abstract class InfoMarketArrayBase extends ArrayLeaf
{
    protected $metadata = [
        'unit'=>'',
        'type'=>'String',
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
        require_once($base.'/'.$entry);
      }
      $d->close();
    }
  
    protected function addClasses()
    {
        foreach ($this->get_declared_classes() as $class) {
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
  
    protected function getCount()
    {
        return count($this->cache);
    }

    protected function getIndexValue(int $index, array $remains)
    {
        return $this->cache[$index];
    }  
  
}  
