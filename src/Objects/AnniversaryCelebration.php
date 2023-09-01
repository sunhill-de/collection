<?php

/**
 * @file AnniversaryCelebration.php
 * Provides informations about an AnniversaryCelebration
 * Lang en
 * Reviewstatus: 2022-09-1
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class AnniversaryCelebration extends Celebration
{

    protected static function setupProperties(PropertyList $list)
    {
          $list->collection('anniversary')
          ->set_description('What anniversary is celebrated')
          ->setAllowedCollection('Anniversary')
          ->searchable()
          ->set_editable(true)
          ->set_groupeditable(true)
          ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','AnniversaryCelebration');
		static::addInfo('table','anniversarycelebrations');
      	static::addInfo('name_s','anniversary celebration',true);
       	static::addInfo('name_p','anniversary celebrations',true);
       	static::addInfo('description','Saves Anniversary Celebrations', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
