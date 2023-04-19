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
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::enum('type')        
            ->set_description('What type of work is this')
            ->setEnumValues(['movie','shortmovie','musicvideo','nonfiction','other'])
            ->setDefault('movie')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::integer('length')
            ->set_description('The length of this work in seconds')
            ->setDefault(0)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        self::varchar('imdb_id')
            ->set_description('The IMDb id of this work')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
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
    static::addInfo('description','Stores informations about visual works', true);
    static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
