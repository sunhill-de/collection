<?php

/**
 * @file Genre.php
 * Provides informations about a genre
 * Lang en
 * Reviewstatus: 2022-08-31
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for mediums
 *
 * @author lokal
 *        
 */
class Genre extends ORMObject
{
    public static $table_name = 'genres';
    
    public static $object_infos = [
        'name'=>'Genre',       // A repetition of static:$object_name @todo see above
        'table'=>'genres',     // A repitition of static:$table_name
        'name_s' => 'genre',
        'name_p' => 'genres',
        'description' => 'Class for genres',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('name')
            ->set_description('The name of this genre')
            ->setMaxLen(70)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::arrayOfStrings('media_type')
            ->set_description('For what kind of medias is this genre')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);            
        self::object('parent')
            ->set_description('What genre does this genre belong to')
            ->setAllowedObjects(['Genre'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
   protected static function setupInfos()
	{
		static::addInfo('name','Genre');
		static::addInfo('table','genres');
      	static::addInfo('name_s','genre',true);
       	static::addInfo('name_p','genres',true);
       	static::addInfo('description','Stores information about music, movie or literature genres');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}

}
