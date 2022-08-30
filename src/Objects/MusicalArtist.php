<?php

/**
 * @file MusicalArtist.php
 * Provides informations about a Musical Artist
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Objects\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for a musical artist
 *
 * @author lokal
 *        
 */
class MusicalArtist extends ORMObject
{
    public static $table_name = 'musicalartists';
    
    public static $object_infos = [
        'name'=>'MusicalArtist',       // A repetition of static:$object_name @todo see above
        'table'=>'musicalartists',     // A repitition of static:$table_name
        'name_s' => 'musical artist',
        'name_p' => 'musical artists',
        'description' => 'Stores informations about a musical artist',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('name')
            ->setMaxLen(100)
            ->set_description('The name of the artist')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::varchar('sort_name')
            ->setMaxLen(100)
            ->set_description('The sorting name of the artist')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::enum('type')        
            ->set_description('The type of the artist')
            ->setEnumValues(['Person', 'Group', 'Orchestra', 'Choir', 'Character', 'Other'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::enum('gender')        
            ->set_description('The gender of the artist or none if group')
            ->setEnumValues(['male', 'female', 'divers', 'none'])
            ->setDefault('none')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::date('begin_date')
            ->set_description('birth or formation date')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::date('end_date')
            ->set_description('death or dissolved date')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::arrayOfStrings('aliases')
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
       	static::addInfo('description','Stores informations about a musical artist');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
