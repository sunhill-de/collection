<?php

/**
 * @file ReadingEvent.php
 * Provides informations about a reading event
 * Lang en
 * Reviewstatus: 2022-09-01
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Objects\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class ReadingEvent extends Event
{
    public static $table_name = 'readingevents';
    
    public static $object_infos = [
        'name'=>'ReadingEvent',       // A repetition of static:$object_name @todo see above
        'table'=>'readingevents',     // A repitition of static:$table_name
        'name_s' => 'reading event',
        'name_p' => 'reading events',
        'description' => 'Stores a event of reading a written work',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::object('work')
            ->set_description('The musical work that was listened to')
            ->setAllowedObjects('WrittenWork')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','ReadingEvent');
		static::addInfo('table','readingevents');
      	static::addInfo('name_s','reading event',true);
       	static::addInfo('name_p','reading events',true);
       	static::addInfo('description','Stores a event of reading a written work');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
