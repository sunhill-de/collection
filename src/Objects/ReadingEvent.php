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
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class ReadingEvent extends Event
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::object('work')
            ->set_description('The written work that was read')
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
       	static::addInfo('description','Stores a event of reading a written work', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
