<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\ORM\Facades\Attributes;
use Sunhill\Visual\Response\SunhillBladeResponse;

class ShowAttributeResponse extends SunhillBladeResponse
{

    protected $template = 'collection::attributes.show';
        
    protected $id;
    
    public function setID(int $id)
    {
        $this->id = $id;
    }
    
    protected function prepareResponse()
    {
        parent::prepareResponse();
        $attribute = Attributes::getAttribute($this->id);
        $short = config('collection.entries_per_short_table',5);
        
        $this->params['id'] = $this->id;
        $this->params['name'] = $attribute->name;
        $this->params['type'] = $attribute->type;
        $this->params['property'] = $attribute->property;
        $this->params['allowed_classes'] = $attribute->allowedobjects;
        
        $this->params['objectcount'] = 0; //Attributes::getAssociatedObjectsCount($this->id);
        $this->params['objects'] = []; //$this->getChildObjects($this->id,0,$short);
    }
    
}  
