<?php

/**
 * @file City.php
 * Provides informations about a city
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Location
 */
namespace Sunhill\Collection\Objects;

/**
 * The class for cities
 *
 * @author lokal
 *        
 */
class City extends Location
{
    public static $table_name = 'cities';
    
    public static $object_infos = [
        'name'=>'City',       // A repetition of static:$object_name @todo see above
        'table'=>'cities',     // A repitition of static:$table_name
        'name_s' => 'city',
        'name_p' => 'cities',
        'description' => 'Class for cities',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('area_code')
            ->setMaxLen(10)
            ->set_description('The area code of this city')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }

    protected static function setupInfos()
	{
		static::addInfo('name','City');
		static::addInfo('table','cities');
       	static::addInfo('name_s','city',true);
       	static::addInfo('name_p','cities',true);
       	static::addInfo('description','Informations about a city');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}

}
