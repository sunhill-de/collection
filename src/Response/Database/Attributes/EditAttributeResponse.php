<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\ORM\Objects\Attribute;

class EditAttributeResponse extends SunhillBladeResponse
{

    protected $template = 'collection::attributes.edit';
    
    protected $id = 0;
    
    public function setID(int $id)
    {
        $this->id = $id;    
    }
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $attribute = Attributes::getAttribute($this->id);
        
        if (empty($attribute)) {
            throw new \Exception("ID '".$this->id."' not found.");
        }
        $this->params['title'] = __('Edit Attribute');
        $this->params['action'] = route('attributes.execedit',['id'=>$this->id]);
                
        $this->params['name'] = $attribute->name;
        $this->params['type'] = $attribute->type;
        $this->params['property'] = $attribute->property;
        $objects = explode(',',$attribute->allowedobjects);
        $this->params['classes'] = [];
        foreach ($objects as $object) {
            $this->params['classes'][] = $object;
        }
    }
    
}    
