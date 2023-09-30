<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\Collection\Utils\HasID;

class DeleteAttributeResponse extends SunhillRedirectResponse
{
    
    use HasID;
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        Attributes::deleteAttribute($this->id);
        $this->target = route('attributes.list');
    }
    
}  
    
