<?php

/**
 * @file Shop.php
 * Provides informations about a shop
 * Lang en
 * Reviewstatus: 2022-08-28
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Location
 */
namespace Sunhill\Objects\Objects;

/**
 * The class for shop
 *
 * @author lokal
 *        
 */
class Shop extends Organisation
{
    public static $table_name = 'shops';
    
    public static $object_infos = [
        'name'=>'Shop',       // A repetition of static:$object_name @todo see above
        'table'=>'shops',     // A repitition of static:$table_name
        'name_s' => 'shop',
        'name_p' => 'shops',
        'description' => 'Class for shops',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::enum('kind')
            ->setEnumValues(['online','local','global','mixed'])
            ->set_description('The kind of shop')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->searchable();
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Shop');
		static::addInfo('table','shops');
       	static::addInfo('name_s','shop',true);
       	static::addInfo('name_p','shops',true);
       	static::addInfo('description','Informations about a shop');
       	static::addInfo('options',0); 
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
