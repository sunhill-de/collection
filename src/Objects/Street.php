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

/**
 * The class for streets
 *
 * @author lokal
 *        
 */
class Street extends Location
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::integer('number_of_houses')
            ->set_description('How many houses are on this street')
            ->set_default(null)
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
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
