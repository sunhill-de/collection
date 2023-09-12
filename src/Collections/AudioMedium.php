<?php

/**
 * @file AudioMedium.php
 * Provides informations about audio mediums
 * Lang en
 * Reviewstatus: 2022-08-30
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Collections;

use Sunhill\ORM\Objects\Collection;
use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for audio medium
 *
 * @author lokal
 *        
 */
class AudioMedium extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
         $list->object('audio_work')
            ->set_description('What release is on this medium')
            ->setAllowedClass('MusicalRelease')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->enum('media_type')        
            ->set_description('What kind of media is this')
            ->setEnumValues(['CD','Vinyl','other'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','AudioMedium');
		static::addInfo('table','audiomediums');
      	static::addInfo('name_s','audio medium',true);
       	static::addInfo('name_p','audio mediums',true);
       	static::addInfo('description','Stores information about an audio medium', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}