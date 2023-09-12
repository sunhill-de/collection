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
namespace Sunhill\Collection\Objects\Locations;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for cities
 *
 * @author lokal
 *        
 */
class City extends Location
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('area_code')
            ->setMaxLen(10)
            ->set_description('The area code of this city')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setDefault(null);
    }

    protected static function setupInfos()
	{
		static::addInfo('name','City');
		static::addInfo('table','cities');
       	static::addInfo('name_s','city',true);
       	static::addInfo('name_p','cities',true);
       	static::addInfo('description','Informations about a city', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}

}
