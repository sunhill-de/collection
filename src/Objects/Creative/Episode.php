<?php

/**
 * @file Episode.php
 * Provides informations about an episode of a series 
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
class Episode extends VisualStandaloneWork
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->object('series')
            ->set_description('The TV series this episode belongs to')
            ->setAllowedClasses('TVSeries')
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
		static::addInfo('table_columns',['name','series'=>'series->name','season','episode','release_date']);
		static::addInfo('keyfield',':name (S:season E:episode)');
  }
}
