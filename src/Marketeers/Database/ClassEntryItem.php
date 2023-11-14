<?php

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\InfoMarket\Items\ArrayInfoMarketItem;
use Sunhill\ORM\Properties\AtomarProperty;

class ClassEntryItem extends AtomarProperty
{
    protected $class_info;
    
    protected static $type = 'Object';
    
    public function __construct($classinfo)
    {
        parent::__construct();
        $this->class_info = $classinfo;
    }
    
    protected function initializeValue(): bool
    {
        return true;
    }
    
    protected function requestTerminalItem(string $name)
    {
        switch ($name) {
            case 'name':
                $result = $this->createResponseFromValue($this->class_info->name);
                return $result->OK()->type('string')->unit('None')->semantic('Name')->readable()->writeable(false)->update('asap');
                break;
            case 'name':
                $result = $this->createResponseFromValue($this->class_info->name);
                return $result->OK()->type('string')->unit('None')->semantic('Name')->readable()->writeable(false)->update('asap');
                break;
        }
    }
    
}

