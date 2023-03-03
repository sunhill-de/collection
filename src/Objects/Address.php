<?php

/**
 * @file Address.php
 * Provides informations about a address
 * Lang en
 * Reviewstatus: 2022-08-28
 * Localization: complete
 * Documentation: complete
 * Tests: none
 * Coverage: unknown
 * Dependencies: Location
 */
namespace Sunhill\Collection\Objects;

/**
 * The class for adresses
 *
 * @author lokal
 *        
 */
class Address extends Location
{
    public static $table_name = 'addresses';
    
    public static $object_infos = [
        'name'=>'Address',       // A repetition of static:$object_name @todo see above
        'table'=>'addresses',     // A repitition of static:$table_name
        'name_s' => 'address',
        'name_p' => 'addresses',
        'description' => 'Class for addresses',
        'options'=>0,           // Reserved for later purposes
    ];
    
    /**
     * Sets up the properties. In this case only the house number. 
     */
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('zip')
            ->setMaxLen(10)
            ->set_description('The zip of this city')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::integer('house_number')
            ->set_description('What is the house number')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Address');
		static::addInfo('table','addresses');
       	static::addInfo('name_s','address',true);
       	static::addInfo('name_p','addresses',true);
       	static::addInfo('description','Informations about an address');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
