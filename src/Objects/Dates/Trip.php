<?php

/**
 * @file Trip.php
 * Provides informations about an Trip
 * Lang en
 * Reviewstatus: 2023-09-12
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects\Dates;

use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyObject;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class Trip extends Date
{
    
    protected static function setupProperties(PropertyList $list)
    {
          $list->array('destinations')
          ->setElementType(PropertyObject::class)
          ->set_description('Where did the trip go to')
          ->setAllowedClasses('Location')
          ->searchable()
          ->set_editable(true)
          ->set_groupeditable(true)
          ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Trip');
		static::addInfo('table','trips');
      	static::addInfo('name_s','trip',true);
       	static::addInfo('name_p','trips',true);
       	static::addInfo('description','Informations about trips', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
