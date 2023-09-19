<?php

/**
 * @file VisualCollection.php
 * Provides informations about a visual collection. That is a abstract collection of either movies
 * or episodes 
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
use Sunhill\ORM\Properties\PropertyCollection;

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
        $list->varchar('tmdb_id')
            ->set_description('The TMDb id of this work')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        $list->array('genres')
            ->setElementType(PropertyCollection::class)
            ->setAllowedClass('Genre')
            ->set_description('What genres is this series associated')
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
		static::addInfo('table_columns',['name','original_name']);
		static::addInfo('keyfield',':name');
  }
}
