<?php

namespace Sunhill\InfoMarket\Response;

use Sunhill\Basic\Loggable;
use Sunhill\InfoMarket\Response\Types\Type;
use Sunhill\InfoMarket\Response\Semantics\Semantic;
use Sunhill\InfoMarket\Response\Units\Unit;

class ResponseManager extends Loggable
{

    protected $types = [];
    
    protected $semantics = [];
    
    protected $units = [];
    
    public function installType(Type $type)
    {
        $this->types[$type->getName()] = $type;
        return $this;
    }
    
    public function installSemantic(Semantic $semantic)
    {
        $this->semantics[$semantic->getName()] = $semantic;
        return $this;
    }
    
    public function installUnit(Unit $unit)
    {
        $this->units[$unit->getName()] = $unit;
        return $this;
    }
    
    public function getType(string $name)
    {
        $name = ucfirst(strtolower($name)); // Normalize name
        
        if (!isset($this->types[$name])) {
            throw new InfoMarketException("The type '$name' doesn't exists.");
        }
        return $this->types[$name];
    }
    
    public function getSemantic(string $name)
    {
        $name = ucfirst(strtolower($name)); // Normalize name
        
        if (!isset($this->sementics[$name])) {
            throw new InfoMarketException("The semantic '$name' doesn't exists.");
        }
        return $this->semantics[$name];
    }
    
    public function getUnit(string $name)
    {
        $name = ucfirst(strtolower($name)); // Normalize name
        
        if (!isset($this->units[$name])) {
            throw new InfoMarketException("The unit '$name' doesn't exists.");
        }
        return $this->units[$name];
    }
    
}
