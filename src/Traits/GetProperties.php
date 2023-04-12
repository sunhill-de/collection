<?php

/**
 * @file GetProperties.php
 * Implements the GetProperties trait that is uses to retrieve
 * a list of properties that define a special feauture (e.g. "Editable")
 * @author Klaus Dimde
 * Lang en (complete)
 * Reviewstatus: 2022-07-30
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Classes
 */

namespace Sunhill\Collection\Traits;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Objects\ORMObject;

trait GetProperties 
{

    protected function testForInt($item)
    {
        if (is_int($item)) {
            return Objects::getClassNamespaceOf($item);
        }
        return false;
    }
    
    protected function testForString($item)
    {
        if (is_string($item)) {
            if (class_exists($item) && is_a($item, ORMObject::class)) {
                // trivial, it's
                return $item;
            } else {
                // It's a string so we think its the id of an class
                return Classes::getNamespaceOfClass($item);
            }
        }
        return false;
    }
    
    protected function testForObject($item)
    {
        if (is_a ($item,ORMObject::class)) {
            return $item::class;
        }
        return false;
    }
    
    /**
     * Depending on whats passed as item it tries to return the namespace of
     * that given class
     * @param unknown $item
     * If item is an int, that it's treated as a object Id
     * If item is a string, than it can be already a namespace of a class Id
     * If Item is a ORMObject return its class
     * @return unknown
     */
    protected function getNamespace($item)
    {
        if ($result = $this->testForInt($item)) {
            return $result;
        }
        if ($result = $this->testForString($item)) {
            return $result;
        }
        if ($result = $this->testForObject($item)) {
            return $result;
        }
        return false;        
    }
    
    /**
     * Return all fields of the given class namepsace that fits the given feature
     * @param string $namespace
     * @param string $feature
     * @return \StdClass[]
     */
    protected function getFields(string $namespace, string $feature)
    {
        $fields = $namespace::staticGetProperties()->where($feature,true)->get();
        $result = [];
        foreach ($fields as $field) {
            $item = new \StdClass();
            $item->name = $field->getName();
            $result[] = $item;
        }
        return $result;
    }
    
    /**
     * Same as getFields excpet that we don't surely know the namespace yet
     * @param unknown $item
     * @param unknown $condition
     * @return unknown
     */
    protected function getFieldsThat($item, $condition)
    {
        $namespace = $this->getNamespace($item);
        return $this->getFields($namespace, $condition);
    }

    /**
     * Return all fields that are editable
     * @param unknown $item
     * @return unknown
     */
    protected function getEditable($item)
    {
        return $this->getFieldsThat($item, 'editable');
    }
    
    /**
     * Return all fields that are displayable
     * @param unknown $item
     * @return unknown
     */
    protected function getDisplayable($item)
    {
        return $this->getFieldsThat($item, 'displayable');
    }

    /**
     * Return all fields that are groupeditable
     * @param unknown $item
     * @return unknown
     */
    protected function getGroupeditable($item)
    {
        return $this->getFieldsThat($item, 'groupeditable');        
    }
}
