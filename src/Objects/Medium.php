<?php

/**
 * @file Medium.php
 * Provides informations about a medium. A medium is any kind of storage for at least one CreativeWork.
 * For example the blu-ray "Matrix" (medium) stores the movie "matrix" (CreativeWork)
 * Lang en
 * Reviewstatus: 2022-08-30
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Objects\Objects;

/**
 * The class for mediums
 *
 * @author lokal
 *        
 */
class Medium extends Property
{
    public static $table_name = 'mediums';
    
    public static $object_infos = [
        'name'=>'Medium',       // A repetition of static:$object_name @todo see above
        'table'=>'mediums',     // A repitition of static:$table_name
        'name_s' => 'medium',
        'name_p' => 'mediums',
        'description' => 'Class for mediums',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('ean')
            ->set_description('What is the EAN of this medium')
            ->setMaxLen(20)
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::object('genre')
            ->set_description('What genre does this medium belong to')
            ->setAllowedObjects(['Genre'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::date('released')
            ->set_description('When was this medium released')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);	    
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Medium');
		static::addInfo('table','mediums');
       	static::addInfo('name_s','medium',true);
       	static::addInfo('name_p','mediums',true);
       	static::addInfo('description','Informations about a medium');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
