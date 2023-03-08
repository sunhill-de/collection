<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Illuminate\Http\Request;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\Visual\Response\SunhillRedirectResponse;

class ExecAddAttributeResponse extends SunhillRedirectResponse
{
    
    /**
     * @todo replace me with a redirect to the dialog
     * @throws \Exception
     */
    protected function nameEmpty()
    {
        throw new \Exception("The Attribute name must't be empty");    
    }
    
    /**
     * @todo replace me with a redirect to the dialog
     * @throws \Exception
     */
    protected function typeEmpty()
    {
        throw new \Exception("The Attribute type must't be empty");
    }
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        if (empty($name = request()->input('name'))) {
            $this->nameEmpty();
        }
        if (empty($type = request()->input('type'))) {
            $this->typeEmpty();
        }
        if (empty(request()->input('allowedclasses'))) {
            $allowed_classes = 'Object';
        } else {
            $allowed_classes = '';
            $first = true;
            foreach (request()->input('allowedclasses') as $class) {
                $allowed_classes .= ($first?"":","). $class;
                $first = false;
            }
        }
        if (empty($property = request()->input('property'))) {
            $property = '';
        }
        Attributes::addAttribute($name,$type,$allowed_classes,$property);
        $this->target = route('attributes.list');
    }
    
}  
    
