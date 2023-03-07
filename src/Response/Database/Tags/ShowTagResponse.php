<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Objects\Tag;
use Sunhill\Visual\Response\SunhillBladeResponse;

class ShowTagResponse extends SunhillBladeResponse
{

    protected $template = 'collection::tags.show';
        
    protected $id;
    
    public function setID(int $id)
    {
        $this->id = $id;
    }
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $tag = Tags::loadTag($this->id);
        $this->params['name'] = $tag->name;
        $this->params['parent'] = ($tag->parent)?$tag->parent->name:'';
        $this->params['fullpath'] = $tag->getFullpath();
        $this->params['leafable'] = ($tag->options & Tag::TO_LEAFABLE)?__('yes'):__('no');
    }
    
}  
