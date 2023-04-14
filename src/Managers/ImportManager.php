<?php

namespace Sunhill\Collection\Managers;

use Sunhill\Visual\Response\SunhillUserException;

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
    
    protected function autodetectFile(string $name)
    {
        $content = file_get_content($name);
        foreach ($this->filters as $name => $filter) {
            if ($filter::autodetect($content)) {
                return $filter;
            }
        }
        return false;
    }
    
    protected function callFilter(string $name, string $filter_class)
    {
        $filter_object = new $filter_class();
        $filter_object->setImportFile($name);
        return $filter_object->run();        
    }
    
    public function importFile(string $name, string $filter = 'autodetect')
    {
        if (!file_exists($name)) {
            throw new SunhillUserException(__("The file ':name' does not exist.",['name'=>$name]));
        }
        if ($filter == 'autodetect') {
            if (!$filter_class = $this->autodetectFile($name)) {
                throw new SunhillUserException(__("The file ':name' was not autodetectable.",['name'=>$name]));
            }
        } else {
            if (!isset($this->filters[$filter])) {
                throw new SunhillUserException(__("Unknown filter: ':name'.",['name'=>$filter]));                
            }
            $filter_class = $this->filters[$filter];
        }
        return $this->callFilter($name, $filter_class);
    }
}
