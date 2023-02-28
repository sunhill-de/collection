<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\Visual\Response\BladeResponse;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Objects\Tag;

class EditTagResponse extends BladeResponse
{

    protected $template = 'collection::tags.edit';
        
    protected function prepareResponse()
    {
        $result = $this->solveRemaining('id');
        $tag_id = $result['id'];
        $tag = Tags::loadTag($tag_id);
        
        $this->params['title'] = __('Edit tag');
        $this->params['action'] = $this->getPrefix().'/Tags/execedit';
        
        $this->params['name'] = $tag->name;
        $this->params['parent_name'] = $tag->parent->fullpath;
        $this->params['parent_id'] = $tag->parent->id;
        $this->params['leafable'] = ($tag->options & TO_LEAFABLE) > 0;
    }
    
}    