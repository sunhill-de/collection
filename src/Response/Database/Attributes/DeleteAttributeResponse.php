<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\ORM\Facades\Attributes;

class DeleteAttributeResponse extends AttributeResponseBase
{
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        Attributes::deleteAttribute($this->id);
        $this->target = route('attributes.list');
    }
    
}  
    
