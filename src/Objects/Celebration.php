<?php

/**
 * @file Celebration.php
 * Provides informations about an Celebration
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
class Celebration extends Date
{
    
    protected static function setupProperties()
    {
          parent::setupProperties();
          self::object('location')
          ->set_description('Where does this celebration take place')
          ->setAllowedObjects('Location')
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
