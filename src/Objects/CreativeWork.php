<?php

/**
 * @file CreativeWork.php
 * Provides informations about a creative Work
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for creative works
 *
 * @author lokal
 *        
 */
class CreativeWork extends ORMObject
{
    
    protected static function setupProperties(PropertyList $list)
    {
        self::varchar('name')
            ->set_description('The name of the creative work')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        self::varchar('original_name')
            ->set_description('The original name of the creative work')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        self::varchar('sort_name')
            ->set_description('The search name of the creative work')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','CreativeWork');
		static::addInfo('table','creativeworks');
       	static::addInfo('name_s','creative work',true);
       	static::addInfo('name_p','creative works',true);
       	static::addInfo('description','Informations about a creative work', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
