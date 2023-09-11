<?php

/**
 * @file EventType.php
 * Provides informations about an event type
 * Lang en
 * Reviewstatus: 2023-09-11
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Collections;

use Sunhill\ORM\Objects\Collection;
use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyVarchar;
use Sunhill\ORM\Properties\PropertyObject;

/**
 * The class for events
 *
 * @author lokal
 * 
 */
class EventType extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('name')
             ->searchable(true)
             ->set_editable(true)
             ->set_groupeditable(true)
             ->set_displayable(true)
             ->set_description('The name of the event type');
        $list->map('translations')
             ->setElementType(PropertyVarchar::class)
             ->set_editable(true)
             ->set_groupeditable(true)
             ->set_displayable(true)
             ->set_description('Translations of this entry.');
    }
    
   protected static function setupInfos()
	{
		static::addInfo('name','EventType');
		static::addInfo('table','eventtypes');
      	static::addInfo('name_s','event type',true);
       	static::addInfo('name_p','event types',true);
       	static::addInfo('description','Stores information about an event type', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}

}
