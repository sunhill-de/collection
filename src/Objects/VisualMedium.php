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

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class VisualMedium extends Medium
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::enum('media_type')        
            ->set_description('What kind of media is this')
            ->setEnumValues(['DVD','Blu-ray','UHD','Digital','Other'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::arrayOfObjects('visual_works')
            ->setAllowedObject('VisualWork')
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
