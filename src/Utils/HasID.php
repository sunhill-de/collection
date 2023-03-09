<?php

namespace Sunhill\Collection\Utils;

trait HasID 
{
    
    protected $id;
    
    public function setID(int $id)
    {
        $this->id = $id;
    }
    
}
