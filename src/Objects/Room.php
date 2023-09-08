<?php

/**
 * @file Room.php
 * Provides informations about a room
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for rooms
 *
 * @author lokal
 *        
 */
class Room extends Location
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->integer('inside')            
            ->set_description('Is this room inside')
            ->setDefault(1)
            ->set_boolean(true)
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        $list->enum('type')        
            ->setEnumValues(['sleep', 'bath', 'living', 'kitchen', 'dining', 'office', 'fun', 'garden', 'other'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->object('owner')
            ->setAllowedClasses('FamilyMember')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Room');
		static::addInfo('table','rooms');
       	static::addInfo('name_s','room',true);
       	static::addInfo('name_p','rooms',true);
       	static::addInfo('description','Informations about a room', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
