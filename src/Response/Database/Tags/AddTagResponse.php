<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\ORM\Facades\Tags;

class AddTagResponse extends SunhillBladeResponse
{

    protected $template = 'collection::tags.edit';
        
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $this->params['title'] = __('Add tag');
        $this->params['action'] = route('tags.execadd');
        $this->params['name'] = '';
        $this->params['parent_name'] = '';
        $this->params['parent_id'] = '';
        $this->params['leafable'] = true;
    }
    
}  
