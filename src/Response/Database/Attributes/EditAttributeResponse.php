<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\Collection\Utils\HasID;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\ORM\Objects\Attribute;

class EditAttributeResponse extends SunhillBladeResponse
{

    protected $template = 'collection::attributes.edit';
    
    use HasID;
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
/*        $attribute = Attributes::getAttribute($this->id);
        
        if (empty($attribute)) {
            throw new \Exception("ID '".$this->id."' not found.");
        } */
        $this->params['title'] = __('Edit Attribute');
        $this->params['action'] = route('attributes.execedit',['id'=>$this->id]);
                
        $this->params['name'] = 'AAA';
        $this->params['type'] = 'integer';
        $this->params['classes'] = [];
    }
    
}    
