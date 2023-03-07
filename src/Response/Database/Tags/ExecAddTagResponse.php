<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Illuminate\Http\Request;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Objects\Tag;
use Sunhill\Visual\Response\SunhillRedirectResponse;

class ExecAddTagResponse extends SunhillRedirectResponse
{
    
    /**
     * @todo replace me with a redirect to the dialog
     * @throws \Exception
     */
    protected function nameEmpty()
    {
        throw new \Exception("The tag name must't be empty");    
    }
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $tag = new Tag();
        if (empty($tag->name = request()->input('name'))) {
            $this->nameEmpty();
        }
        if ($parent_id = request()->input('value_parent')) {
            $tag->parent = Tags::loadTag(intval($parent_id));
        }
        if (request()->input('leafable')) {
            $tag->options = TO_LEAFABLE;
        }
        Tags::addTag($tag);
        $this->target = route('tags.list');
    }
    
}  
    
