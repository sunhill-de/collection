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
abstract class TagResponseBase extends SunhillRedirectResponse
{
    
    abstract protected function getWorkingTag();    
      
    protected function prepareResponse()
    {    
        $tag = $this->getWorkingTag();
      
        if (empty($name = request()->input('name'))) {
          throw new \Exception(__("Tag name must't be empty"));
        }
        $tag->setName($name);
      
        $parent = request()->input('value_parent');
        if (!empty($parent)) {
            $tag->parent = $parent;
        }
      
        if (request()->input('leafable')) {
          $options = TO_LEAFABLE;
        }  else {
          $options =  0;
        }  
        $tag->options = $options;
        $tag->commit();
    }

}  
    
