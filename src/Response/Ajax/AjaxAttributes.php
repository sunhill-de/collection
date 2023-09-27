<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxResponse;
use Illuminate\Support\Facades\DB;
use Sunhill\ORM\Facades\Tags;

class AjaxAttributes extends AjaxResponse
{
    
    protected function assembleOutput(string $search)
    {
        if (!empty($this->parameter1)) {
            
        }
    }
    
}