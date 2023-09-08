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
class Episode extends VisualWork
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->integer('length')
            ->set_description('The length of this work in seconds')
            ->setDefault(0)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        $list->object('series')
            ->set_description('The TV series this episode belongs to')
            ->setAllowedClass('TVSeries')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        $list->integer('season')
            ->set_description('Number of season')
            ->setDefault(0)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->integer('episode')
            ->set_description('Number of season')
            ->setDefault(0)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','Episode');
		static::addInfo('table','episodes');
        static::addInfo('name_s','episode',true);
        static::addInfo('name_p','episodes',true);
        static::addInfo('description','Stores informations about an episode', true);
        static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
