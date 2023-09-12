<?php

/**
 * @file Location.php
 * Provides informations about a location
 * Lang en
 * Reviewstatus: 2022-08-28
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects\Locations;

use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for locations
 *
 * @author lokal
 *        
 */
class Location extends ORMObject
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('name')
            ->setMaxLen(100)
            ->set_description('The name of the location')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        $list->object('part_of')
            ->setAllowedClasses('Location')
            ->set_description('The location is part of')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
    {
        static::addInfo('name','Location');
        static::addInfo('table','locations');
        static::addInfo('name_s','location',true);
        static::addInfo('name_p','locations',true);
        static::addInfo('description','A class for locations', true);
        static::addInfo('options',0);
        static::addInfo('editable',true);
        static::addInfo('instantiable',true);
    }
    
    
}
