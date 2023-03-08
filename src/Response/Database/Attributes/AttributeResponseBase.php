<?php

/**
 * 
 */
namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\Visual\Response\SunhillRedirectResponse;

/**
 * A baseclass for adding oder modifying Attributes
 */
class AttributeResponseBase extends SunhillRedirectResponse
{
    
    protected $id;
    
    public function setID(int $id)
    {
        $this->id = $id;
    }

}  
    
