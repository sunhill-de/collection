<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\InfoMarket\Items\ArrayInfoMarketItem;

class ClassesItem extends ArrayInfoMarketItem
{

    static protected $named_array = true;
    
    protected $classes = [];
    
    /**
     * Setup this item with the name 'classes'
     */
    public function __construct()
    {
        parent::__construct();
        $this->setName('classes');
    }
    
    /**
     * Return the current number of installed classes
     * @return int
     */
    protected function getCountValue(): int
    {
        return Classes::getClassCount();
    }

    protected function getNamedEntries()
    {
        $classes = Classes::getAllClasses();
        
        foreach ($classes as $classname => $classinfo) {
            $this->classes[$classname] = new ClassEntryItem($classinfo);
        }
        
        return $this->classes;
    }
    
    protected function getIndexedElement(int $index)
    {
        $classes = Classes::getAllClasses();
        foreach ($classes as $class) {
            if (!$index--) {
                return $class;
            }
        }
    }
    
    protected function getNamedElement(string $name)
    {
        $classes = Classes::getAllClasses();
        return $this->getClassEntry($classes[$name]);
    }
    
    protected function getClassEntry($class)
    {
        $entry = new ClassEntryItem($class);
        return $entry;
    }
}

