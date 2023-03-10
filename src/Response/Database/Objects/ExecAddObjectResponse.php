<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\RedirectResponse;
use Sunhill\ORM\Facades\Classes;

class ExecAddObjectResponse extends ObjectResponseBase
{
    
    protected $target = '/';

    protected function getWorkingObject()
    {
        $classname = request()->input('_class');
        $this->target = route('objects.list',['key'=>$classname]); 
        
        return Classes::createObject($classname);       
    }
    
}  
    
