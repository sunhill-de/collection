<?php

/**
 * @file Movie.php
 * Provides informations about a movie 
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for movies
 *
 * @author lokal
 *        
 */
class VisualCollection extends CreativeCollection
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('imdb_id')
        ->set_description('The IMDb id of this work')
        ->setDefault(null)
        ->searchable()
        ->set_editable(true)
        ->set_groupeditable(false)
        ->set_displayable(true);
        $list->integer('tmdb_id')
        ->set_description('The TMDb id of this work')
        ->setDefault(null)
        ->searchable()
        ->set_editable(true)
        ->set_groupeditable(false)
        ->set_displayable(true);
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','VisualCollection');
		static::addInfo('table','visualcollections');
        static::addInfo('name_s','Visual collection',true);
        static::addInfo('name_p','Visual collections',true);
        static::addInfo('description','Stores informations about collection of movies or a tv-series', true);
        static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
