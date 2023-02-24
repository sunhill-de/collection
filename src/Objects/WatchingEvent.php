<?php

/**
 * @file WatchingEvent.php
 * Provides informations about a watching event
 * Lang en
 * Reviewstatus: 2022-09-01
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for Watching events
 *
 * @author lokal
 *        
 */
class WatchingEvent extends Event
{
    public static $table_name = 'watchingevents';
    
    public static $object_infos = [
        'name'=>'WatchingEvent',       // A repetition of static:$object_name @todo see above
        'table'=>'watchingevents',     // A repitition of static:$table_name
        'name_s' => 'watching event',
        'name_p' => 'watching events',
        'description' => 'Stores a event of watching a visual work',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::object('work')
            ->set_description('The visual work that was watched')
            ->setAllowedObjects('VisualWork')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','WatchingEvent');
		static::addInfo('table','watchingevents');
      	static::addInfo('name_s','watching event',true);
       	static::addInfo('name_p','watching events',true);
       	static::addInfo('description','Stores a event of watching a visual work');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
