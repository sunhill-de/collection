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
namespace Sunhill\Objects\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for ProductGroups
 *
 * @author lokal
 *        
 */
class ProductGroup extends ORMObject
{
    public static $table_name = 'productgroups';
    
    public static $object_infos = [
        'name'=>'ProductGroup',       // A repetition of static:$object_name @todo see above
        'table'=>'productgroups',     // A repitition of static:$table_name
        'name_s' => 'product group',
        'name_p' => 'product groups',
        'description' => 'Stores Informations about a product group',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('name')
            ->setMaxLen(100)
            ->set_description('')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::object('part_of')
            ->set_description('This group is part of more general group')
            ->setAllowedObjects('ProductGroup')
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
       	static::addInfo('description','Stores Informations about a product group');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
