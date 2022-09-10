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
namespace Sunhill\Objects\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for audio medium
 *
 * @author lokal
 *        
 */
class AudioMedium extends ORMObject
{
    public static $table_name = 'audiomediums';
    
    public static $object_infos = [
        'name'=>'AudioMedium',       // A repetition of static:$object_name @todo see above
        'table'=>'audiomediums',     // A repitition of static:$table_name
        'name_s' => 'audio medium',
        'name_p' => 'audio mediums',
        'description' => 'Stores information about an audio medium',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::object('audio_work')
            ->set_description('What release is on this medium')
            ->setAllowedObjects('MusicalRelease')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::enum('media_type')        
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
       	static::addInfo('description','Stores information about an audio medium');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
