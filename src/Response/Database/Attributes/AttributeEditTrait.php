<?php

namespace Sunhill\Collection\Response\Database\Attributes;

trait AttributeEditTrait
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
        if (empty($result['type'] = request()->input('type'))) {
            if (property_exists($this, 'id')) {
                $this->error('name',__("':field' mustn't be empty.",['field'=>'Type']),['id'=>$this->id]);
            } else {
                $this->error('name',__("':field' mustn't be empty.",['field'=>'Type']));
            }
        }
        if (empty(request()->input('allowedclasses'))) {
            $result['allowed_classes'] = 'Object';
        } else {
            $result['allowed_classes'] = '';
            $first = true;
            foreach (request()->input('allowedclasses') as $class) {
                $result['allowed_classes'] .= ($first?"":","). $class;
                $first = false;
            }
        }
        if (empty($result['property'] = request()->input('property'))) {
            $result['property'] = '';
        }
        return $result;
    }        
}