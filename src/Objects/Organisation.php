<?php

/**
 * @file Organisation.php
 * Provides informations about a organisation
 * Lang en
 * Reviewstatus: 2022-08-28
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Location
 */
namespace Sunhill\Objects\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for organisation
 *
 * @author lokal
 *        
 */
class Organisation extends ORMObject
{
    public static $table_name = 'organisations';
    
    public static $object_infos = [
        'name'=>'Organisation',       // A repetition of static:$object_name @todo see above
        'table'=>'organisations',     // A repitition of static:$table_name
        'name_s' => 'organisation',
        'name_p' => 'organisations',
        'description' => 'Class for organisations',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('name')
            ->setMaxLen(50)
            ->set_description('The name of this organisation')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Organisation');
		static::addInfo('table','organisations');
       	static::addInfo('name_s','organisation',true);
       	static::addInfo('name_p','organisations',true);
       	static::addInfo('description','Informations about an organisation');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
