<?php

/**
 * @file Clip.php
 * Provides informations about a short piece of visual media (like a video clip) 
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
class Clip extends VisualStandaloneWork
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->object('relation')
            ->set_description('Is this clip related to something')
            ->setAllowedClasses('object')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);        
        $list->enum('type')
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
		static::addInfo('table_columns',['name','length','type']);
		static::addInfo('keyfield',':name');
  } 
}
