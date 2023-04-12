<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\Visual\Response\SunhillBladeResponse;
use Sunhill\Collection\Utils\HasID;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Objects\Tag;

class EditTagResponse extends SunhillBladeResponse
{

    protected $template = 'collection::tags.edit';
    
    use HasID, CheckTag;
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $this->checkTag();
        
        $tag = Tags::loadTag($this->id);
        
        $this->params['title'] = __('Edit tag');
        $this->params['action'] = route('tags.execedit',['id'=>$this->id]);
                
        $this->params['name'] = $tag->name;
        if (isset($tag->parent)) {
          $this->params['input_parent'] = $tag->parent->fullpath;
          $this->params['value_parent'] = $tag->parent->id;
        }
        $this->params['leafable'] = ($tag->options & TO_LEAFABLE)>0;
    }
    
}    
