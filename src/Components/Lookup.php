<?php

namespace Sunhill\Collection\Components;

use Illuminate\View\Component;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Objects;
use Sunhill\Visual\Facades\Dialogs;

class Lookup extends Component
{
    
    public $id;
    
    public $name;

    public $type;
    
    public $target;
    
    public $value_field;
    
    public $value_id;
    
    public $value_name;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $id, string $name, string $type, string $target = "", 
        string $valueid = "", string $valuename = "")
    {
        $this->id = $id;
        $this->name  = $name;
        if (!in_array($type,['object','table','tag','attribute'])) {
            throw new \Exception("Invalid type '$type'");
        }
        $this->type = $type;
        $this->target = $target;
        $this->value_id = $valueid;
        $this->value_name = $valuename;
    }

    protected function getGeneralParams()
    {
        return [
            'field_name'=>$this->name,
            'field_lookup'=>'lookup_'.$this->name,
        ];
    }

    protected function getObjectParams()
    {
        $result = $this->getGeneralParams();
        $result['field_value'] = $this->value_id;
        $result['field_lookup_value'] = $this->value_name;
        $result['lookup_method'] = 'lookupObject';
        $result['target'] = $this->target;
        return $result;
    }
    
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        switch ($this->type) {
            case 'object':
                $params = $this->getObjectParams(); 
                break;
            case 'table':
                break;
            case 'tag':
                break;
            case 'attribute':
                break;
        }
        return view('collection::components.lookup', $params);
     }
}
