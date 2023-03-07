<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\RedirectResponse;
use Sunhill\ORM\Facades\Classes;

class DeleteTagResponse extends TagResponseBase
{
    
    protected $target = '/';
   
    protected function getWorkingTag()
    {
        $id = $this->solveRemaining('id');
        
        $tag = Tags::loadTag($id);
        $this->target = $this->getPrefix().'/Tags/show/'.$id;
        
        return $tag;
    }

}  
    
