<?php

/**
 * @file .php
 * Provides informations about 
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class  extends ORMObject
{
     
    protected static function setupProperties(PropertyList $list)
    {
/*        self::varchar('')
            ->setMaxLen(100)
            ->set_description('')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::object('')
            ->set_description('')
            ->setAllowedObjects('')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::enum('')        
            ->set_description('')
            ->setEnumValues([])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::date('')
            ->set_description('')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::float('')
            ->set_description('')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::arrayOfObjects('')
            ->setAllowedObject('')
            ->set_description('')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true); 
        self::arrayOfStrings('')
            ->set_description('')
            ->set_editable(true)
            ->set_groupeditable(true);            
            
            */
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','');
		static::addInfo('table','');
      	static::addInfo('name_s','',true);
       	static::addInfo('name_p','',true);
       	static::addInfo('description','', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
