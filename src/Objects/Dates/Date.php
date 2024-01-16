<?php

/**
 * @file Date.php
 * Provides informations about a date
 * Lang en
 * Reviewstatus: 2023-09-12
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects\Dates;

use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyObject;

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
        $list->varchar('name')
            ->setMaxLen(100)
            ->set_description('The name of the date')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        $list->date('begin_date')
            ->searchable()
            ->set_description('The start date of the date')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->time('begin_time')
            ->setDefault(null)
            ->set_description('The start time of the date')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->date('end_date')
            ->setDefault(null)
            ->set_description('The end date of the date')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->time('end_time')
            ->set_editable(true)
            ->set_description('The end time of the date')
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setDefault(null);
        $list->array('persons')
            ->setElementType(PropertyObject::class)
            ->setAllowedClasses('Friend')
            ->set_description('The involved persons')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setDefault(null)
            ->searchable();
        $list->string('unique_id')
             ->setMaxLen(30)
             ->set_description('A unique id of this date (maybe identical to _uuid)')
             ->set_displayable(true)
             ->set_editable(true)
             ->set_groupeditable(false)
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
