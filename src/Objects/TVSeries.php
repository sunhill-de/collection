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
class TVSeries extends VisualWork
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::integer('number_of_seasons')
            ->set_description('The total number of seasons')
            ->setDefault(0)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        self::integer('number_of_episodes')
            ->set_description('The total number of episodes')
            ->setDefault(0)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','TVSeries');
		static::addInfo('table','tvseries');
        static::addInfo('name_s','TV series',true);
        static::addInfo('name_p','TV series',true);
        static::addInfo('description','Stores informations about TV series', true);
        static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}