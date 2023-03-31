<?php

/**
 * @file ListeningEvent.php
 * Provides informations about a listening event
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
class ListeningEvent extends Event
{
     
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::object('work')
            ->set_description('The musical work that was listened to')
            ->setAllowedObjects('MusicalRecording')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','ListeningEvent');
		static::addInfo('table','listeningevents');
      	static::addInfo('name_s','listening event',true);
       	static::addInfo('name_p','listening events',true);
       	static::addInfo('description','Stores a event of listening to a musical work', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
