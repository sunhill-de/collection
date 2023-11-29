<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxSearchResponse;
use Sunhill\ORM\Facades\Collections;

class AjaxCollections extends AjaxSearchResponse
{
    
    protected function assembleSearchResult(string $search)
    {
        $result = [];
        $classes = Collections::getAllCollections();
        foreach ($classes as $class => $info) {
            if (strpos($class,$search) !== false) {
                $result[] = $this->makeStdclass(['label'=>$class,'id'=>$class]);
            }
        }
        return $result;        
    }
    
}