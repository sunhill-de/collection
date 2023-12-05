<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxSearchResponse;
use Illuminate\Support\Facades\DB;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Facades\InfoMarket;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Collection\Exceptions\UnknownCollectionException;

class AjaxObjectField extends AjaxPropertiesCollectionField
{
    
    protected function searchNamespace(string $name): string
    {
        if (empty($namespace = Classes::getNamespaceOfClass($name))) {
            throw new UnknownCollectionException("The collection '$name' does not exist.");
        }
        return $namespace;
    }
    
}