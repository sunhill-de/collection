<?php

namespace Sunhill\Collection\Managers;

class ImportManager
{
    
    protected $filters = [];
    
    public function registerFilter(string $name, string $class)
    {
        $this->filters[$name] = $class;
    }
    
    public function getFilters()
    {
        return $this->filters;
    }
}
