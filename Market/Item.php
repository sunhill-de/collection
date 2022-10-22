<?php

namespace Sunhill\InfoMarket\Market;

abstract class Item extends Leaf
{
    
    protected $metadata = [];
    
    /**
     * The constructor overwrites the default metadata values with the ones 
     * defined for this item
     */
    public function __construct()
    {
        parent::__construct();
        // Overwrite the defaults (if necessary)
        foreach ($this->metadata as $key => $value) {
            $this->default_metadata[$key] = $value;
        }
    }
    
}