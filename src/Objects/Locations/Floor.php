<?php

/**
 * @file Floor.php
 * Provides informations about a floor
 * Lang en
 * Reviewstatus: 2022-09-19
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects\Locations;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for floors
 *
 * @author lokal
 *        
 */
class Floor extends Location
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->integer('level')            
            ->set_description('On what level is this floor')
            ->setDefault(1)
            ->set_boolean(true)
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Floor');
		static::addInfo('table','floors');
       	static::addInfo('name_s','floor',true);
       	static::addInfo('name_p','floors',true);
       	static::addInfo('description','Informations about a floor', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
