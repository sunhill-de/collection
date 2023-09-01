<?php

/**
 * @file Date.php
 * Provides informations about a date
 * Lang en
 * Reviewstatus: 2022-03-17
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for properties
 *
 * @author lokal
 *        
 */
class Date extends ORMObject
{
    
    protected static function setupProperties(PropertyList $list)
    {
        self::varchar('name')
            ->setMaxLen(100)
            ->set_description('The name of the date')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::date('begin_date')
            ->searchable()
            ->set_description('The start date of the date')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::time('begin_time')
            ->setDefault(null)
            ->set_description('The start time of the date')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::date('end_date')
            ->setDefault(null)
            ->set_description('The end date of the date')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::time('end_time')
            ->set_editable(true)
            ->set_description('The end time of the date')
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setDefault(null);
        self::arrayOfObjects('persons')
            ->setAllowedObjects('Friend')
            ->set_description('The involved persons')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setDefault(null)
            ->searchable();
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Date');
		static::addInfo('table','dates');
       	static::addInfo('name_s','date',true);
       	static::addInfo('name_p','dates',true);
       	static::addInfo('description','Informations about a date', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
