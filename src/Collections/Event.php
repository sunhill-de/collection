<?php

/**
 * @file Event.php
 * Provides informations about an event
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
 * Examples:
 * who      | when           | what     | to_whom       | payload
 * ---------+----------------+----------+---------------+---------
 * Person A | Dec 20th, 2023 | watched  | Die hard      |
 *          | Sep 11th, 2023 | switched | Lightswitch A | on
 *          | Sep 11th, 2023 | changed  | Temperature A | 20.1 °C
 */
class Event extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->object('who')
             ->setAllowedClasses(['Person','Property'])
             ->set_editable(true)
             ->set_groupeditable(true)
             ->set_displayable(true)
             ->set_description('What person or item triggered the event');
        $list->datetime('when')
             ->set_editable(true)
             ->set_groupeditable(true)
             ->set_displayable(true)
             ->set_description('When was the event triggered');
        $list->collection('what')
             ->setAllowedCollection('EventType')
             ->set_editable(true)
             ->set_groupeditable(true)
             ->set_displayable(true)
             ->set_description('What kind of events was triggered');        
        $list->object('to_whom')
             ->setAllowedClasses(['Person','Medium','Property'])
             ->set_editable(true)
             ->set_groupeditable(true)
             ->set_displayable(true)
             ->set_description('Who or what was the target of the event');
        $list->varchar('payload')
             ->set_editable(true)
             ->set_groupeditable(true)
             ->set_displayable(true)
             ->set_description('Additional infos to this event (see example above)');
    }
    
   protected static function setupInfos()
	{
		static::addInfo('name','Event');
		static::addInfo('table','events');
      	static::addInfo('name_s','event',true);
       	static::addInfo('name_p','events',true);
       	static::addInfo('description','Stores information about an event', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}

}