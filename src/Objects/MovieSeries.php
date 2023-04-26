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

/**
 * The class for movies
 *
 * @author lokal
 *        
 */
class MovieSeries extends VisualCollection
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','MovieSeries');
		static::addInfo('table','movieseries');
        static::addInfo('name_s','Movie series',true);
        static::addInfo('name_p','Movie series',true);
        static::addInfo('description','Stores informations about movie series', true);
        static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
