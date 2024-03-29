<?php

/**
 * @file MusicalArtist.php
 * Provides informations about a Musical Artist
 * Lang en
 * Reviewstatus: 2023-09-12
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Collections;

use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyVarchar;
use Sunhill\ORM\Objects\Collection;

/**
 * The class for a musical artist
 *
 * @author lokal
 *        
 */
class MusicalArtist extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
         $list->varchar('name')
            ->setMaxLen(100)
            ->set_description('The name of the artist')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable()
            ->set_sortable(true);
        $list->varchar('sort_name')
            ->setMaxLen(100)
            ->set_description('The sorting name of the artist')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable()
            ->set_sortable(true);
        $list->enum('type')        
            ->set_description('The type of the artist')
            ->setEnumValues(['person', 'group', 'orchestra', 'choir', 'character', 'other'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->enum('gender')        
            ->set_description('The gender of the artist or none if group')
            ->setEnumValues(['male', 'female', 'divers', 'none'])
            ->setDefault('none')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->date('begin_date')
            ->set_description('birth or formation date')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->date('end_date')
            ->set_description('death or dissolved date')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->array('aliases')
            ->setElementType(PropertyVarchar::class)
            ->set_description('Aliases/misspellings for this artist')
            ->set_editable(true)
            ->searchable()
            ->set_groupeditable(true);            
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','MusicalArtist');
		static::addInfo('table','musicalartists');
      	static::addInfo('name_s','musical artist',true);
       	static::addInfo('name_p','musical artists',true);
       	static::addInfo('description','Stores informations about a musical artist', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		static::addInfo('table_columns',['name','sort_name','type','gender','begin_date']);
		static::addInfo('keyfield',':name');
    }
}
