<?php

namespace Sunhill\Collection\Utils;

use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\Dialogs;

class Collector
{
    protected $values = [];
    
    protected $references = [];
    
    public $reference_tree = [];
    
    protected function addValue($key, $entry)
    {
        if (isset($this->values[$key])) {
            if (is_array($this->values[$key])) {
                $this->values[$key][] = $entry;
            } else {
                $value = $this->values[$key];
                $this->values[$key] = [$value, $entry];                
            }
        } else {
            $this->values[$key] = $entry;
        }
    }
    
    public function addInteger(string $key, $value)
    {
        $entry = new CollectorEntry();
        $entry->setInteger($key, $value);
        $this->addValue($key, $entry);
        
        return $entry;
    }
    
    public function addString(string $key, $value)
    {
        $entry = new CollectorEntry();
        $entry->setString($key, $value);        
        $this->addValue($key, $entry);
        
        return $entry;
    }
    
    public function addDate(string $key, $value)
    {
        $entry = new CollectorEntry();
        $entry->setDate($key, $value);
        $this->addValue($key, $entry);        
        
        return $entry;
    }
    
    public function addFloat(string $key, $value)
    {
        $entry = new CollectorEntry();
        $entry->setFloat($key, $value);
        $this->addValue($key, $entry);        
        
        return $entry;
    }
    
    public function addTime(string $key, $value)
    {
        $entry = new CollectorEntry();
        $entry->setTime($key, $value);
        $this->addValue($key, $entry);
        
        return $entry;
    }
    
    public function addDateTime(string $key, $value)
    {
        $entry = new CollectorEntry();
        $entry->setDateTime($key, $value);
        $this->addValue($key, $entry);
        
        return $entry;
    }
    
    public function addText(string $key, $value)
    {
        $entry = new CollectorEntry();
        $entry->setText($key, $value);
        $this->addValue($key, $entry);
        
        return $entry;
    }
    
    protected function searchObjectReference(string $class, string $keyfield, $values)
    {
        $namespace = Classes::getNamespaceOfClass($class);
        return $namespace::search()->where($keyfield,$values[$keyfield])->firstID(); 
    }
    
    protected function enterTree($entry)
    {
        if (empty($classname = $entry->getClassname())) {
            return;
        }
        if (isset($this->reference_tree[$classname])) {
            $this->reference_tree[$classname][] = $entry;
        } else {
            $this->reference_tree[$classname] = [$entry];
        }
    }
    
    public function addObject(string $key, string $class, string $keyfield, string $namefield, $values)
    {
        $entry = new CollectorEntry();
        $entry->setObject($key, $values)->keyfield($keyfield)->namefield($namefield)->classname($class);
        $entry->externalReference($this->searchObjectReference($class, $keyfield, $values));
        $entry->internalReference(count($this->references));
        $this->references[] = $entry;
        $this->addValue($key, $entry);
        $this->enterTree($entry);
        
        return $entry;
    }
    
    public function addPerson(string $key, $values)
    {
        $entry = new CollectorEntry();
        $entry->setObject($key, $values)->classname('Person');
        
        $entry->externalReference(Dialogs::searchKeyfield('Person', $values['firstname'].' '.$values['lastname']));
        $entry->internalReference(count($this->references));
        $this->references[] = $entry;
        $this->addValue($key, $entry);        
        $this->enterTree($entry);
        
        return $entry;
    }
    
    public function __get($name)
    {
        if (isset($this->values[$name])) {
            return $this->values[$name]->getValue();
        }
    }
}