<?php

namespace Sunhill\Collection\Utils;

class CollectorEntry
{
    protected $col_type = 'undefined';
    
    protected $col_name = '';
    
    protected $col_value;
    
    protected $col_keyfield = '';
    
    protected $col_namefield = '';
    
    protected $col_classname = '';
    
    protected $col_external_ref;
    
    protected $col_internal_ref;
    
    protected function setParams($name, $value)
    {
        $this->col_name = $name;
        $this->col_value = $value;        
    }
    
    public function setInteger(string $name, $value)
    {
        $this->col_type = 'integer';
        $this->setParams($name, $value);
        return $this;
    }
    
    public function setString(string $name, $value)
    {
        $this->col_type = 'string';
        $this->setParams($name, $value);
        return $this;
    }
    
    public function setFloat(string $name, $value)
    {
        $this->col_type = 'float';
        $this->setParams($name, $value);
        return $this;        
    }
    
    public function setDate(string $name, $value)
    {
        $this->col_type = 'date';
        $this->setParams($name, $value);
        return $this;
    }
    
    public function setTime(string $name, $value)
    {
        $this->col_type = 'time';
        $this->setParams($name, $value);
        return $this;
    }
    
    public function setDateTime(string $name, $value)
    {
        $this->col_type = 'datetime';
        $this->setParams($name, $value);
        return $this;
    }
    
    public function setText(string $name, $value)
    {
        $this->col_type = 'text';
        $this->setParams($name, $value);
        return $this;
    }
    
    public function setObject(string $name, $values)
    {
        $this->col_type = 'object';
        foreach ($values as $key => $value) {
            $this->$key = $value;
        }
        $this->col_name = $name;
        return $this;
    }
    
    public function keyfield(string $name)
    {
        $this->col_keyfield = $name;
        return $this;
    }
    
    public function namefield(string $name)
    {
        $this->col_namefield = $name;
        return $this;
    }
    
    public function classname(string $name)
    {
        $this->col_classname = $name;    
    }
    
    public function externalReference($reference)
    {
        $this->col_external_ref = $reference;
        return $this;
    }
        
    public function internalReference($reference)
    {
        $this->col_internal_ref = $reference;
        return $this;
    }
    
    public function getType()
    {
        return $this->col_type;
    }
    
    public function getName()
    {
        return $this->col_name;
    }
    
    public function getValue()
    {
        return $this->col_value;
    }
    
    public function getExternalReference()
    {
        return $this->col_external_ref;
    }
    
    public function getInternalReference()
    {
        return $this->col_internal_ref;
    }
    
    public function getClassname()
    {
        return $this->col_classname;
    }
}