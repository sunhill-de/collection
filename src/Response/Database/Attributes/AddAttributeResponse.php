<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\Visual\Response\SunhillBladeResponse;

class AddAttributeResponse extends SunhillBladeResponse
{

    protected $template = 'collection::attributes.edit';
        
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $this->params['title'] = __('Add attribute');
        $this->params['action'] = route('attributes.execadd');
        $this->params['name'] = '';
        $this->params['parent_name'] = '';
        $this->params['parent_id'] = '';
        $this->params['leafable'] = true;
    }
    
}  
