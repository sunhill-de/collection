<?php

/**
 * @file MovieSeries.php
 * Provides informations about a movie series 
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
class MovieSeries extends VisualCollection
{
    
    protected static function setupProperties(PropertyList $list)
    {
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
