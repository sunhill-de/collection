<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\Visual\Response\BladeResponse;
use Sunhill\ORM\Facades\Tags;

class ShowTagResponse extends BladeResponse
{

    protected $template = 'collection::tags.show';
        
    protected function prepareResponse()
    {
    }
    
}  
