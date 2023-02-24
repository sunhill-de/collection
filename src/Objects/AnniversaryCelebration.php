<?php

/**
 * @file AnniversaryCelebration.php
 * Provides informations about an AnniversaryCelebration
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
class AnniversaryCelebration extends Celebration
{
    public static $table_name = 'anniversarycelebrations';
    
    public static $object_infos = [
        'name'=>'AnniversaryCelebration',       // A repetition of static:$object_name @todo see above
        'table'=>'anniversarycelebrations',     // A repitition of static:$table_name
        'name_s' => 'anniversary celebration',
        'name_p' => 'anniversary celebrations',
        'description' => 'Stores informations about an anniversary celebration',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
          parent::setupProperties();
          self::object('anniversary')
          ->set_description('What anniversary is celebrated')
          ->setAllowedObjects('Anniversary')
          ->searchable()
          ->set_editable(true)
          ->set_groupeditable(true)
          ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','AnniversaryCelebration');
		static::addInfo('table','anniversarycelebrations');
      	static::addInfo('name_s','anniversary celebration',true);
       	static::addInfo('name_p','anniversary celebrations',true);
       	static::addInfo('description','Saves Anniversary Celebrations');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
