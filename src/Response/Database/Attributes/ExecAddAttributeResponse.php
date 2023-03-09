<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Illuminate\Http\Request;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\Visual\Response\SunhillFormActionResponse;

class ExecAddAttributeResponse extends SunhillFormActionResponse
{

    use AttributeEditTrait;
    
    protected $title = 'Add attribute';
    
    protected $action = 'attributes.execadd';
    
    protected $form = 'collection::attributes.edit'; 

    protected function prepareResponse()
    {
        parent::prepareResponse();
        $params = $this->checkParams();
        Attributes::addAttribute($params['name'],$params['type'],$params['allowed_classes'],$params['property']);
        $this->target = route('attributes.list');
    }
    
}  
    
