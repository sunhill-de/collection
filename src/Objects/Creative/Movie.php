<?php

/**
 * @file Movie.php
 * Provides informations about a movie 
 * Lang en
 * Reviewstatus: 2023-09-12
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects\Creative;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for movies
 *
 * @author lokal
 *        
 */
class Movie extends VisualStandaloneWork
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->object('series')
            ->set_description('Does this movie belong to a series')
            ->setAllowedClass('MovieSeries')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);        
        $list->integer('number_in_series')
            ->set_description('The number of this movie in the series')
            ->setDefault(null)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','Movie');
		static::addInfo('table','movies');
        static::addInfo('name_s','movie',true);
        static::addInfo('name_p','movies',true);
        static::addInfo('description','Stores informations about a movie', true);
        static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
