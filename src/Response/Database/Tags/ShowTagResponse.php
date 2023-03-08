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
    
    protected function getChildTags()
    {
        return Tags::getChildTagsOf($this->id);
    }
    
    protected function getChildObjects()
    {
        return [];    
    }
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $tag = Tags::loadTag($this->id);
        $short = config('collection.entries_per_short_table',5);
        $this->params['id'] = $this->id;
        $this->params['name'] = $tag->name;
        $this->params['parent'] = ($tag->parent)?$tag->parent->name:'';
        $this->params['fullpath'] = $tag->getFullpath();
        $this->params['leafable'] = ($tag->options & Tag::TO_LEAFABLE)?__('yes'):__('no');
        $this->params['childtagcount'] = Tags::getChildTagCount($this->id);
        $this->params['tags'] = Tags::getChildTagsOf($this->id,0,$short);
        $this->params['objectcount'] = Tags::getAssociatedObjectsCount($this->id);
        $this->params['objects'] = $this->getChildObjects($this->id,0,$short);
    }
    
}  
