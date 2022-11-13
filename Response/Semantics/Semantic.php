<?php

namespace Sunhill\InfoMarket\Response\Semantics;

use Sunhill\InfoMarket\Response\ResponseElement;

class Semantic extends ResponseElement
{
    /**
     * Semantics are organized hirarchic. So overwrite this method to get a parent semantic (e.g. "AirTemp" is a child of "Temp")
     * @return string the Name of the parent semantic or empty if no parent
     */
    public function getParent(): string
    {
        return '';
    }
    
    /**
     * Normally all entries of this semantic have the same unit, so define it here 
     * @return string The name of the unit
     */
    public function getDefaultUnit(): string
    {
        return '';
    }
    
    /**
     * Normally all entries of this semantic have the same type, so define it here
     * @return string The name of the type
     */
    public function getDefaultType(): string
    {
        return 'Str';
    }
    
    /**
     * A semantic can process a value and and transform it into another one
     * @return a processes value (by default just pass it through)
     */
    public function processValue($value)
    {
        return $value;
    }
    
    /**
     * With this method it is possible to define a conversion to display a raw value in a human readable one
     * @return string: The human readable representation of value
     */
    public function processHumanReadableValue($value, string $human_readable_unit = ''): string
    {
        return $value.(empty($human_readable_unit)?"":" ".$human_readable_unit);
    }
    
    protected function translate(string $input): string
    {
        return $input;
    }
    
}
