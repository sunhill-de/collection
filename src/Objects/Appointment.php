<?php

/**
 * @file Appointment.php
 * Provides informations about an Appointment
 * Lang en
 * Reviewstatus: 2022-09-1
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
class Appointment extends Date
{
    
    protected static function setupProperties()
    {
          parent::setupProperties();
          self::enum('type')        
            ->set_description('What type of Appointment is this')
            ->setEnumValues(['doctor','school'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Appointment');
		static::addInfo('table','appointments');
      	static::addInfo('name_s','appointment',true);
       	static::addInfo('name_p','appointments',true);
       	static::addInfo('description','Saves appointments', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
