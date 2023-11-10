<?php

/**
 * @file Anniversary.php
 * Provides informations about an anniversary
 * Lang en
 * Reviewstatus: 2023-09-13
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Collections;

use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Objects\Collection;
use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyObject;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class Anniversary extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
          $list->varchar('name')
            ->setMaxLen(100)
            ->set_description('Name of the anniversary')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable()
            ->set_sortable(true);
        $list->date('first')
            ->set_description('When was the first event')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->set_sortable(true);
        $list->enum('type')        
            ->set_description('What type of anniversary is this')
            ->setEnumValues(['birthday','deathday','weddingday','other'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->set_sortable(true);
        $list->array('persons')
            ->setElementType(PropertyObject::class)
            ->setAllowedClasses('Friend')
            ->set_description('What persons are part of this anniversary')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true); 
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Anniversary');
		static::addInfo('table','anniversaries');
      	static::addInfo('name_s','anniversary',true);
       	static::addInfo('name_p','anniversaries',true);
       	static::addInfo('description','Stores anniversaries of different types of anniversaries', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		static::addInfo('table_columns',['name','type']);
		static::addInfo('keyfield',':name');
    }
}
