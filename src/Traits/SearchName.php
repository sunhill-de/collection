<?php

/**
 * @file SearchName.php
 * Implements the suggestSearchName function, that creates a search name from the given title 
 * @author Klaus Dimde
 * Lang en (complete)
 * Reviewstatus: 2023-04-24
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Classes
 */

namespace Sunhill\Collection\Traits;

trait SearchName
{

    protected function suggestSearchName(string $name): string
    {
        $name = strtolower($name);
        if (in_array(substr($name,0,4),['the ','der ','die ','das ','ein '])) {
            $name = substr($name,3).substr($name,0,3);
        }
        return preg_replace('/[^A-Za-z0-9\-]/', '', $name);         
    }
        
}
