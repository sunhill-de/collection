<?php

/**
 * @file CreativeWork.php
 * Provides informations about a creative Work
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Objects\Objects;

/**
 * The class for creative works
 *
 * @author lokal
 *        
 */
class CreativeWork extends ORMObject
{
    public static $table_name = 'creativeworks';
    
    public static $object_infos = [
        'name'=>'Creativework',       // A repetition of static:$object_name @todo see above
        'table'=>'creativeworks',     // A repitition of static:$table_name
        'name_s' => 'creative work',
        'name_p' => 'creative works',
        'description' => 'Class for creative works',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('name')
            ->set_description('The name of the creative work')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        self::arrayOfObjects('creators')
            ->setAllowedObject('Person')
            ->set_description('Who created this work')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','CreativeWork');
		static::addInfo('table','creativeworks');
       	static::addInfo('name_s','creative work',true);
       	static::addInfo('name_p','creative works',true);
       	static::addInfo('description','Informations about a creative work');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
