<?php

/**
 * @file Organisation.php
 * Provides informations about a organisation
 * Lang en
 * Reviewstatus: 2023-09-12
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Location
 */
namespace Sunhill\Collection\Objects\Organisations;

use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for organisation
 *
 * @author lokal
 *        
 */
class Organisation extends ORMObject
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('name')
            ->setMaxLen(50)
            ->set_description('The name of this organisation')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Organisation');
		static::addInfo('table','organisations');
       	static::addInfo('name_s','organisation',true);
       	static::addInfo('name_p','organisations',true);
       	static::addInfo('description','Informations about an organisation', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
