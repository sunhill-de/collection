<?php

/**
 * @file VisualWork.php
 * Provides informations about visual work 
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

/**
 * The class for written works
 *
 * @author lokal
 *        
 */
class VisualWork extends CreativeWork
{
    public static $table_name = 'visualworks';
    
    public static $object_infos = [
        'name'=>'VisualWork',       // A repetition of static:$object_name @todo see above
        'table'=>'visualworks',     // A repitition of static:$table_name
        'name_s' => 'visual work',
        'name_p' => 'visual works',
        'description' => 'Stores informations about visual works',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::enum('type')        
            ->set_description('What type of work is this')
            ->setEnumValues(['movie','shortmovie','musicvideo','nonfiction','other'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::arrayOfObjects('directors')
            ->setAllowedObject('person')
            ->set_description('Who is/are the director(s)')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true); 
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','VisualWork');
		static::addInfo('table','visualworks');
    static::addInfo('name_s','visual work',true);
    static::addInfo('name_p','visual works',true);
    static::addInfo('description','Stores informations about visual works');
    static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
