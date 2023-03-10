<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\Collection\Utils\HasID;
use Sunhill\ORM\Facades\Tags;

class DeleteTagResponse extends SunhillRedirectResponse
{
    
    use HasID;
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        Tags::deleteTag($this->id);
        $this->target = route('tags.list');
    }
    
}  
    
