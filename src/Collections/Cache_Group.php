<?php

/**
 * @file Cache_Groups.php
 * Provides a group a cache_item ca belong to
 * Lang en
 * Reviewstatus: 2023-12-21
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
class Cache_Group extends Collection
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
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Cache_Group');
		static::addInfo('table','cache_groups');
      	static::addInfo('name_s','cache group',true);
       	static::addInfo('name_p','cache groups',true);
       	static::addInfo('description','Stores the groups a cache item can belong to', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		static::addInfo('table_columns',['name']);
		static::addInfo('keyfield',':name');
    }
}
