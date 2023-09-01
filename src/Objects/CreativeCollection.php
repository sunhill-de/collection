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

/**
 * The class for creative works
 *
 * @author lokal
 *        
 */
class CreativeCollection extends CreativeWork
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->integer('item_count')
        ->set_description('How many items belong to this collection')
        ->setDefault(null)
        ->searchable()
        ->set_editable(true)
        ->set_groupeditable(false)
        ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','CreativeCollection');
		static::addInfo('table','creativecollections');
       	static::addInfo('name_s','creative collection',true);
       	static::addInfo('name_p','creative collections',true);
       	static::addInfo('description','Informations about a collection of creative works', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
