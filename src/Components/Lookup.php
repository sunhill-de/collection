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
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $id, string $name, string $type, string $target = "", string $value_field = 'name')
    {
        $this->id = $id;
        $this->name  = $name;
        if (!in_array($type,['object','table','tag','attribute'])) {
            throw new \Exception("Invalid type '$type'");
        }
        $this->type = $type;
        $this->target = $target;
        $this->value_field = $value_field;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view(
            'collection::components.varchar',
            [
                'name'=>$this->name,
                'value'=>(is_null($this->object))?null:$this->object->$name
            ]);
    }
}
