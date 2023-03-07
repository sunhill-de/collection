<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Utils\ObjectList;
use Sunhill\Visual\Traits\GetProperties;

/**
 * A baseclass for adding oder modifying tags
 */
class TagResponseBase extends SunhillRedirectResponse
{
    
    protected $id;
    
    public function setID(int $id)
    {
        $this->id = $id;
    }

}  
    
