<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\Visual\Response\BladeResponse;
use Sunhill\ORM\Facades\Tags;

class AddTagResponse extends BladeResponse
{

    protected $template = 'collection::tags.edit';
        
    protected function prepareResponse()
    {
        $this->params['title'] = __('Add tag');
        $this->params['action'] = $this->getPrefix().'/Tags/execaddtag';
        $this->params['name'] = '';
        $this->params['parent_name'] = '';
        $this->params['parent_id'] = '';
        $this->params['leafable'] = true;
    }
    
}  
