<?php

/**
 * @file Event.php
 * Provides informations about an event
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Location
 */
namespace Sunhill\Objects\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for events
 *
 * @author lokal
 *        
 */
class Event extends ORMObject
{
    public static $table_name = 'events';
    
    public static $object_infos = [
        'name'=>'Event',       // A repetition of static:$object_name @todo see above
        'table'=>'events',     // A repitition of static:$table_name
        'name_s' => 'event',
        'name_p' => 'events',
        'description' => 'Class for events',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::datetime('start_stamp')
            ->set_description('When did this event start')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::datetime('end_stamp')
            ->setMaxLen(10)
            ->set_description('When did this event end')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::integer('interrupted')
            ->setDefault(0)
            ->set_description('Was this event interrupted')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }

    protected static function setupInfos()
	{
		static::addInfo('name','Event');
		static::addInfo('table','events');
       	static::addInfo('name_s','event',true);
       	static::addInfo('name_p','events',true);
       	static::addInfo('description','Informations about an event');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}

}
'
