<?php

/**
 * @file Manufacturer.php
 * Provides informations about a manufacturer
 * Lang en
 * Reviewstatus: 2022-08-28
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Organisation
 */
namespace Sunhill\Collection\Objects;

/**
 * The class for manufacturers
 *
 * @author lokal
 *        
 */
class Manufacturer extends Organisation
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::arrayOfObjects('product_groups')
            ->setAllowedObjects('ProductGroup')
            ->set_description('What product groups does this manufacturer make')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->searchable();
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','Manufacturer');
		static::addInfo('table','manufacturers');
        static::addInfo('name_s','manufacturer',true);
        static::addInfo('name_p','manufacturers',true);
        static::addInfo('description','Informations about a manufacturer', true);
        static::addInfo('options',0); 
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
