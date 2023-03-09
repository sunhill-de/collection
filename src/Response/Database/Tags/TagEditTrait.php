<?php

namespace Sunhill\Collection\Response\Database\Tags;

trait TagEditTrait
{
    function checkParams()
    {
        $result = [];
        if (empty($result['name'] = request()->input('name'))) {
            if (property_exists($this, 'id')) {
                $this->error('name',__("':field' mustn't be empty.",['field'=>'Name']),['id'=>$this->id]);
            } else {
                $this->error('name',__("':field' mustn't be empty.",['field'=>'Name']));                
            }
        }
        if (request()->input('leafable')) {
            $result['options'] = Tag::TO_LEAFABLE;
        } else {
            $result['options'] = 0;
        }
        if ($parent = request()->input('input_parent')) {
            $result['parent'] = $parent;
        }        
        return $result;
    }
    
}