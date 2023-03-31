<?php

/**
 * @file Anniversary.php
 * Provides informations about an anniversary
 * Lang en
 * Reviewstatus: 2022-09-1
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class Anniversary extends ORMObject
{
    
    protected static function setupProperties()
    {
          parent::setupProperties();
          self::varchar('name')
            ->setMaxLen(100)
            ->set_description('Name of the anniversary')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::date('first')
            ->set_description('When was the first event')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::enum('type')        
            ->set_description('What type of anniversary is this')
            ->setEnumValues(['birthday','deathday','weddingday','other'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::arrayOfObjects('persons')
            ->setAllowedObjects('Friend')
            ->set_description('What persons are part of this anniversary')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true); 
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Anniversary');
		static::addInfo('table','anniversaries');
      	static::addInfo('name_s','anniversary',true);
       	static::addInfo('name_p','anniversaries',true);
       	static::addInfo('description','Stores anniversaries of different types', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
