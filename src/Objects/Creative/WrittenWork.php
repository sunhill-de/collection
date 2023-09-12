<?php

/**
 * @file WrittenWork.php
 * Provides informations about written work 
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects\Creative;

use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyObject;

/**
 * The class for written works
 *
 * @author lokal
 *        
 */
class WrittenWork extends CreativeWork
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->enum('type')        
            ->set_description('What type of work is this')
            ->setEnumValues(['nonfiction','novel','shortstory','graphicnovel','other'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->array('authors')
            ->setElementType(PropertyObject::class)
            ->setAllowedClasses('Person')
            ->set_description('Who is/are the author(s)')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true); 
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','WrittenWork');
		static::addInfo('table','writtenworks');
        static::addInfo('name_s','written work',true);
        static::addInfo('name_p','written works',true);
        static::addInfo('description','Stores informations about written works', true);
        static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
