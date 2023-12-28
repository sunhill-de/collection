<?php

/**
 * @file Cache_ItemTemplate.php
 * A template for a cache_item
 * Lang en
 * Reviewstatus: 2023-12-28
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Collections;

use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Objects\Collection;
use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyObject;
use Sunhill\ORM\Properties\PropertyVarchar;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class Cache_ItemTemplate extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
          $list->varchar('name')
            ->setMaxLen(100)
            ->set_description('A name of this Template')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable()
            ->set_sortable(true);
        $list->varchar('command')
             ->setMaxLen(300)
             ->set_description('What would be the command be formed like')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->array('parameters')
            ->setElementType(PropertyVarchar::class)
            ->set_description('A list of parameters that this command expects')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->enum('type',['command','http'])
            ->set_description('What kind of item is this')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Cache_ItemTemplate');
		static::addInfo('table','cache_itemstemplates');
      	static::addInfo('name_s','cache item template',true);
       	static::addInfo('name_p','cache item templates',true);
       	static::addInfo('description','Stores templates for cache items', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		static::addInfo('table_columns',['name','type']);
		static::addInfo('keyfield',':name');
    }
}
