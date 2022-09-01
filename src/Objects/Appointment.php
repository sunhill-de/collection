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
namespace Sunhill\Objects\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class Appointment extends Date
{
    public static $table_name = 'appointments';
    
    public static $object_infos = [
        'name'=>'Appointment',       // A repetition of static:$object_name @todo see above
        'table'=>'appointments',     // A repitition of static:$table_name
        'name_s' => 'appointment',
        'name_p' => 'appointments',
        'description' => 'Stores informations about an appointment',
        'options'=>0,           // Reserved for later purposes
    ];
    
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
       	static::addInfo('description','Saves appointments');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
