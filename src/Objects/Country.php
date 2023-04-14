<?php

/**
 * @file Country.php
 * Provides informations about a country
 * Lang en
 * Reviewstatus: 2022-08-28
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Location
 */
namespace Sunhill\Collection\Objects;

/**
 * The class for countries
 *
 * @author lokal
 *        
 */
class Country extends Location
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('iso_code')
            ->setMaxLen(2)
            ->set_description('The iso code of this country')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::object('capital')
            ->setAllowedObjects('City')
            ->set_description('The capital of this country')
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        self::varchar('country_code')        
            ->setMaxLen(5)
            ->set_description('The phone prefix')
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true)
            ->setDefault(null);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Country');
		static::addInfo('table','countries');
       	static::addInfo('name_s','country',true);
       	static::addInfo('name_p','countries',true);
       	static::addInfo('description','Informations about a country', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
