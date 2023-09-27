<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxSearchResponse;
use Sunhill\ORM\Facades\Classes;

class AjaxClasses extends AjaxSearchResponse
{
    
    protected function assembleSearchResult(string $search)
    {
        $result = [];
        $classes = Classes::getAllClasses();
        foreach ($classes as $class => $info) {
            if (strpos($class,$search) !== false) {
                $result[] = $this->makeStdclass(['label'=>$class,'id'=>$class]);
            }
        }
        return $result;
    }
    
}