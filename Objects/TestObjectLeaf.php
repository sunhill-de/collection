<?php

namespace Sunhill\InfoMarket\Tests\Objects;

use Sunhill\InfoMarket\Market\ObjectLeaf;

class TestObjectLeaf extends ObjectLeaf
{
    public $object;
    
    public $str = 'ABC';
    
    public $int = 123;
    
    public $float = 1.23;
    
    public function initObj()
    {
        $this->object = new TestObjectLeaf();
        $this->object->str = 'DEF';
        $this->object->int = 456;
        $this->object->float = 4.56;
    }
    
    protected function getAllowedFields()
    {
        return ['str','int','float','obj'];
    }
    
    protected function getObjectValue(string $name, array $remaining)
    {
        switch ($name)
        {
            case 'str': return $this->str;
            case 'int': return $this->int;
            case 'float': return $this->float;
            case 'obj': return $this->object;
        }
    }
    
    protected function setObjectValue(string $first, $value, $remaining)
    {
        switch ($first)
        {
            case 'str': $this->str = $value;
            case 'int': $this->int = $value;
            case 'float': $this->float = $value;
        }
    }
    
}

