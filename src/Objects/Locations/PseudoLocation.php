<?php

/**
 * @file PseudoLocation.php
 * Provides informations about a pseudo location. That is a location inside another location more in form
 * of a collection for items (liks a server rack)
 * Lang en
 * Reviewstatus: 2023-12-18
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects\Locations;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for rooms
 *
 * @author lokal
 *        
 */
class PseudoLocation extends Location
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->string('description')            
            ->set_description('A description of this "room"')
            ->setDefault("")
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','PseudoLocation');
		static::addInfo('table','pseudolocations');
       	static::addInfo('name_s','pseudo location',true);
       	static::addInfo('name_p','pseudo locations',true);
       	static::addInfo('description','Informations about a pseudo location', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		static::addInfo('table_columns',['name','part_of'=>'part_of->name','description']);
		static::addInfo('keyfield',':name');
    }
}
