<?php

/**
 * @file ProductGroup.php
 * Provides informations about ProductGroups
 * Lang en
 * Reviewstatus: 2022-09-1
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Collections;

use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Objects\Collection;

/**
 * The class for ProductGroups
 *
 * @author lokal
 *        
 */
class ProductGroup extends Collection
{
     
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('name')
            ->setMaxLen(100)
            ->set_description('')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        $list->collection('part_of')
            ->set_description('This group is part of more general group')
            ->setAllowedCollection('ProductGroup')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','ProductGroup');
		static::addInfo('table','productgroups');
      	static::addInfo('name_s','product group',true);
       	static::addInfo('name_p','product groups',true);
       	static::addInfo('description','Stores Informations about a product group', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		
		static::addInfo('table_columns',['name','part_of'=>'part_of->name']);
		static::addInfo('keyfield',':name');
		
    }
}
