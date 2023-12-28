<?php

/**
 * @file Cache_Entry.php
 * Provides informations about an entry to the cache
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
class Cache_Entry extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
       $list->collection('item')
            ->setAllowedCollection('Cache_Item')
            ->set_description('What item is stored here')
            ->set_displayable(true)
            ->searchable();
        $list->integer('best_before')
            ->set_description('Unix time of when this entry will be invalidated')
            ->set_displayable(true);
        $list->datetime('last_run')
            ->set_description('Timestamp of when this entry was created')
            ->set_displayable(true);
        $list->text('entry')
            ->set_description('The result of the last command')
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Cache_Entry');
		static::addInfo('table','cache_entries');
      	static::addInfo('name_s','cache entry',true);
       	static::addInfo('name_p','cache entries',true);
       	static::addInfo('description','Stores cached entry of an item', true);
       	static::addInfo('options',0);
		static::addInfo('table_columns',['name','best_before','last_run']);
		static::addInfo('keyfield',':name');
    }
}
