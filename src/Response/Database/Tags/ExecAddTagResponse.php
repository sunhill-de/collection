<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Illuminate\Http\Request;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Objects\Tag;
use Sunhill\Visual\Response\SunhillFormActionResponse;

class ExecAddTagResponse extends SunhillFormActionResponse
{
    
    use TagEditTrait;
    
    protected $title = 'Add tags';
    
    protected $action = 'tags.execadd';
    
    protected $form = 'collection::tags.edit';
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $params = $this->checkParams();
        Tags::addTag($params);
        $this->target = route('tags.list');
    }
    
}  
    
