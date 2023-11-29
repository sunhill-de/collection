<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxSearchResponse;
use Sunhill\ORM\Facades\Attributes;

class AjaxAttributes extends AjaxSearchResponse
{
    
    protected function assembleGeneralAttributes(string $search)
    {
        $query = Attributes::query()->get();
       
        $result = [];
        foreach ($query as $attribute) {
            if (strpos($attribute->name,$search) !== false) {
                $result[] = $this->makeStdclass(['label'=>$attribute->name,'id'=>$attribute->id]);
            }
        }
        
        return $result;
    }
    
    protected function assembleClassAttributes(string $search, string $class)
    {
        $query = Attributes::query()->get();
        
        $result = [];
        foreach ($query as $attribute) {
            if ((strpos($attribute->name,$search) !== false) && (strpos($attribute->allowed_classes,$class) !== false)) {
                $result[] = $this->makeStdclass(['label'=>$attribute->name,'id'=>$attribute->id]);
            }
        }
        
        return $result;
        
    }
    
    protected function assembleSearchResult(string $search)
    {
        if (empty($this->parameter1)) {
            return $this->assembleGeneralAttributes($search); 
        } else {
            return $this->assembleClassAttributes($search, $this->parameter1);
        }
    }
    
}