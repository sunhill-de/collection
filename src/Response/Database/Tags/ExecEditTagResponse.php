<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\SunhillFormActionResponse;
use Sunhill\Collection\Utils\HasID;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Objects\Tag;

class ExecEditTagResponse extends SunhillFormActionResponse
{
    
    use HasID, TagEditTrait, CheckTag;
    
    protected $title = 'Edit tags';
    
    protected $action = 'tags.execedit';
    
    protected $form = 'collection::tags.edit';
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $this->checkTag();
        
        $params = $this->checkParams();
        $this->target = route('tags.list');
        Tags::changeTag($this->id,$params);
    }

}  
    
