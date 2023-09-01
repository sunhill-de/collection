<?php

/**
 * @file Street.php
 * Provides informations about a street
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for streets
 *
 * @author lokal
 *        
 */
class Street extends Location
{
    
    protected static function setupProperties(PropertyList $list)
    {
        self::integer('number_of_houses')
            ->set_description('How many houses are on this street')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->setDefault(null);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Street');
		static::addInfo('table','streets');
       	static::addInfo('name_s','street',true);
       	static::addInfo('name_p','streets',true);
       	static::addInfo('description','Informations about a street');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
