<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Illuminate\Http\Request;

use Sunhill\Visual\Response\SunhillRedirectResponse;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\ORM\Objects\Attribute;

class ExecEditAttributeResponse extends AttributeResponseBase
{
    
    /**
     * @todo replace me with a redirect to the dialog
     * @throws \Exception
     */
    protected function nameEmpty()
    {
        throw new \Exception("The Attribute name must't be empty");
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
        Attributes::updateAttribute($this->id,$name,$type,$allowed_classes,$property);
        $this->target = route('attributes.list');
    }

}  
    
