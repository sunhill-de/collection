<?php

/**
 * @file Cache_Item.php
 * Provides informations about a item that stores its data into the cache
 * Lang en
 * Reviewstatus: 2023-12.21
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

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class Cache_Item extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
          $list->varchar('name')
            ->setMaxLen(100)
            ->set_description('A name of this item')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable()
            ->set_sortable(true);
        $list->enum('type',['command','http'])
            ->set_description('What kind of item is this')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);        
        $list->varchar('command')
             ->setMaxLen(300)
             ->set_description('What command to execute')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->collection('cache_group')
            ->setAllowedCollection('Cache_Group')
            ->set_description('What group does this item belong to')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->set_sortable(true);
        $list->enum('cache_update')
            ->set_description('In what frequency should this item be updated')
            ->setEnumValues(['minute','five-minute','ten-minute','hour','day','week'])
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->integer('random_seed')
            ->set_description('What random second count should be added to the invalid timestamp')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Cache_Item');
		static::addInfo('table','cache_items');
      	static::addInfo('name_s','cache item',true);
       	static::addInfo('name_p','cache items',true);
       	static::addInfo('description','Stores items that can store their data into the cache', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		static::addInfo('table_columns',['name','group','update','item']);
		static::addInfo('keyfield',':name');
    }
}
