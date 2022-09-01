<?php

/**
 * @file Manufacturer.php
 * Provides informations about a manufacturer
 * Lang en
 * Reviewstatus: 2022-08-28
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Organisation
 */
namespace Sunhill\Objects\Objects;

/**
 * The class for manufacturers
 *
 * @author lokal
 *        
 */
class Manufacturer extends Organisation
{
    public static $table_name = 'manufacturers';
    
    public static $object_infos = [
        'name'=>'Manufacturer',       // A repetition of static:$object_name @todo see above
        'table'=>'manufacturers',     // A repitition of static:$table_name
        'name_s' => 'manufacturer',
        'name_p' => 'manufacturers',
        'description' => 'Class for a manufacturer',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::arrayOfObjects('product_groups')
            ->setAllowedObjects('ProductGroup')
            ->set_description('What product groups does this manufacturer make')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->searchable();
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','Manufacturer');
		static::addInfo('table','manufacturers');
    static::addInfo('name_s','manufacturer',true);
    static::addInfo('name_p','manufacturers',true);
    static::addInfo('description','Informations about a manufacturer');
    static::addInfo('options',0); 
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
