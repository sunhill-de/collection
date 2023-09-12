<?php

/**
 * @file Celebration.php
 * Provides informations about an Celebration
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

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class Celebration extends Date
{
    
    protected static function setupProperties(PropertyList $list)
    {
          $list->object('location')
          ->set_description('Where does this celebration take place')
          ->setAllowedClass('Location')
          ->searchable()
          ->set_editable(true)
          ->set_groupeditable(true)
          ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Celebration');
		static::addInfo('table','celebrations');
      	static::addInfo('name_s','celebration',true);
       	static::addInfo('name_p','celebrations',true);
       	static::addInfo('description','Saves Celebrations', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
