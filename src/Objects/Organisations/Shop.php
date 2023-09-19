<?php

/**
 * @file Shop.php
 * Provides informations about a shop
 * Lang en
 * Reviewstatus: 2023-09-12
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Location
 */
namespace Sunhill\Collection\Objects\Organisations;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for shop
 *
 * @author lokal
 *        
 */
class Shop extends Organisation
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->enum('kind')
            ->setEnumValues(['online','local','global','mixed'])
            ->set_description('The kind of shop')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->searchable();
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Shop');
		static::addInfo('table','shops');
       	static::addInfo('name_s','shop',true);
       	static::addInfo('name_p','shops',true);
       	static::addInfo('description','Informations about a shop', true);
       	static::addInfo('options',0); 
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		static::addInfo('table_columns',['name','kind']);
		static::addInfo('keyfield',':name');
    }
}
