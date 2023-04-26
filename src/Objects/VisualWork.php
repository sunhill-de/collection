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
        self::integer('length')
            ->set_description('The length of this work in seconds')
            ->setDefault(null)
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
        self::integer('tmdb_id')
            ->set_description('The TMDb id of this work')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        self::text('plot')
            ->set_description('The plot of this movie')
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true)
            ->setDefault(null);
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
