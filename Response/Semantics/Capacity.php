<?php
/**
 * @file Capacity.php
 * Provides the semantic capacity that stands for a amount of bytes (e.g. size of a harddisk)
 * Lang en
 * Reviewstatus: 2022-11-08
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\InfoMarket\Response\Semantics;

class Duration extends Semantic
{
    public function __construct()
    {
        $this->setName('Capacity');
    }

    /**
     * Normally all entries of this semantic have the same type, so define it here
     * @return string The name of the type
     */
    public function getDefaultType(): string
    {
        return 'Integer';
    }
    
    /**
     * With this method it is possible to define a conversion to display a raw value in a human readable one
     * @return string: The human readable representation of value
     */
    public function processHumanReadableValue($value, string $human_readable_unit = ''): string
    {
        if ($value >= 1000*1000*1000*1000) {
            return round($value/(1000*1000*1000*1000),1).' TB';
        } elseif ($value >= 1000*1000*1000) {
            return round($value/(1000*1000*1000),1).' GB';
        } elseif ($value >= 1000*1000) {
            return round($value/(1000*1000),1).' MB';
        } elseif ($value >= 1000) {
            return round($value/1000,1).' kB';
        } else {
            return $value.' Byte';
        }
    }
    
}
