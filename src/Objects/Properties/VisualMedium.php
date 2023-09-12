<?php

/**
 * @file VisualMediaum.php
 * Provides informations about a VisualMedium (like a DVD or Blu-Ray)
 * Lang en
 * Reviewstatus: 2022-08-30
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Medium
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyObject;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class VisualMedium extends Medium
{
    
    protected static function setupProperties(PropertyList $list)
    {
       $list->enum('media_type')        
            ->set_description('What kind of media is this')
            ->setEnumValues(['DVD','Blu-ray','UHD','Digital','Other'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->array('visual_works')
            ->setElementType(PropertyObject::class)
            ->setAllowedClasses('VisualWork')
            ->set_description('What visual works are on that medium.')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true); 
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','VisualMedium');
		static::addInfo('table','visualmediums');
      	static::addInfo('name_s','visual medium',true);
       	static::addInfo('name_p','visual mediums',true);
       	static::addInfo('description','Stores informations about a visual medium', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
