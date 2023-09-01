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
class Clip extends VisualWork
{
    
    protected static function setupProperties(PropertyList $list)
    {
        self::integer('length')
            ->set_description('The length of this work in seconds')
            ->setDefault(0)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        self::object('relation')
            ->set_description('Is this clip related to something')
            ->setAllowedObject(['object'])
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);        
        self::enum('type')
            ->setEnumValues(['music','private','other'])
            ->setDefault('other')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','Clip');
		static::addInfo('table','clips');
        static::addInfo('name_s','clip',true);
        static::addInfo('name_p','clips',true);
        static::addInfo('description','Stores informations about a clip', true);
        static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
