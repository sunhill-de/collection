<?php

/**
 * @file Trip.php
 * Provides informations about an Trip
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
class Trip extends Date
{
    public static $table_name = 'trips';
    
    public static $object_infos = [
        'name'=>'Trip',       // A repetition of static:$object_name @todo see above
        'table'=>'trips',     // A repitition of static:$table_name
        'name_s' => 'trip',
        'name_p' => 'trips',
        'description' => 'Informations about trips',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
          parent::setupProperties();
          self::arrayOfObjects('destinations')
          ->set_description('Where did the trip go to')
          ->setAllowedObjects('Location')
          ->searchable()
          ->set_editable(true)
          ->set_groupeditable(true)
          ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Trip');
		static::addInfo('table','trips');
      	static::addInfo('name_s','trip',true);
       	static::addInfo('name_p','trips',true);
       	static::addInfo('description','Informations about trips');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
