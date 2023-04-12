<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\Collection\Utils\HasID;
use Sunhill\ORM\Facades\Tags;
use Sunhill\Visual\Response\SunhillUserException;

trait CheckTag
{
    
    protected function checkTag()
    {
        if (!Tags::getTag($this->id)) {
            throw new SunhillUserException(__("The tag with the id ':id' does not exists.",['id'=>$this->id]));
        }
    }
    
}  
    
