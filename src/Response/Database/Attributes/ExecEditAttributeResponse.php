<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\ORM\Objects\Attribute;
use Sunhill\Visual\Response\SunhillFormActionResponse;

class ExecEditAttributeResponse extends SunhillFormActionResponse
{
    
    protected $title = 'Edit attribute';
    
    protected $action = 'attributes.execedit';
    
    protected $form = 'collection::attributes.edit';
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $params = $this->checkParams();
        Attributes::updateAttribute($this->id,$params['name'],$params['$type'],$params['allowed_classes'],$params['property']);
        $this->target = route('attributes.list');
    }

}  
    
