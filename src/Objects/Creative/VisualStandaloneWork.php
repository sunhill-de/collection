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
namespace Sunhill\Collection\Objects\Creative;

use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyCollection;

/**
 * The class for written works
 *
 * @author lokal
 *        
 */
class VisualStandaloneWork extends CreativeStandaloneWork
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->integer('length')
            ->set_description('The length of this work in minutes')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        $list->varchar('imdb_id')
            ->set_description('The IMDb id of this work')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        $list->varchar('tmdb_id')
            ->set_description('The TMDb id of this work')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        $list->text('plot')
            ->set_description('The plot of this work')
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true)
            ->setDefault(null);
        $list->array('genres')
            ->setElementType(PropertyCollection::class)
            ->setAllowedClass('Genre')
            ->set_description('What genres is this work associated')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
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
		static::addInfo('table_columns',['name','length']);
		static::addInfo('keyfield',':name');
  }
}
