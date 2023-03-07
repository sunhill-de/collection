<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Objects\Tag;

class ExecEditTagResponse extends SunhillRedirectResponse
{
    
    protected $target = '/';
   
    protected $id = 0;
    
    /**
     * @todo replace me with a redirect to the dialog
     * @throws \Exception
     */
    protected function nameEmpty()
    {
        throw new \Exception("The tag name must't be empty");
    }
    
    public function setID(int $id)
    {
        $this->id = $id;
    }
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        if (empty($name = request()->input('name'))) {
            $this->nameEmpty();
        }
        $fields = ['name'=>$name];
        if (request()->input('leafable')) {
            $fields['options'] = Tag::TO_LEAFABLE;
        }
        if ($parent = request()->input('input_parent')) {
            $fields['parent'] = $parent;
        }
        $this->target = route('tags.list');
        Tags::changeTag($this->id,$fields);
    }

}  
    
