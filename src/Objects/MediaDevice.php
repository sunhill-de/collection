<?php

/**
 * @file MediaDevice.php
 * Provides informations about a media device
 * Lang en
 * Reviewstatus: 2022-09-1
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

/**
 * The class for media devices
 *
 * @author lokal
 *        
 */
class MediaDevice extends NetworkDevice
{
    public static $table_name = 'mediadevices';
    
    public static $object_infos = [
        'name'=>'MediaDevice',       // A repetition of static:$object_name @todo see above
        'table'=>'mediadevices',     // A repitition of static:$table_name
        'name_s' => 'media device',
        'name_p' => 'media devices',
        'description' => 'Class for media devices',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::enum('media_type')
            ->set_description('What kind of device is this')
            ->setEnumValues(['tv','console','echo','other'])
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->searchable();
    }
    
    protected static function setupInfos()
    {
        static::addInfo('name','MediaDevice');
        static::addInfo('table','mediadevices');
        static::addInfo('name_s','media device',true);
        static::addInfo('name_p','media devices',true);
        static::addInfo('description','Informations about a media device');
        static::addInfo('options',0);
        static::addInfo('editable',true);
        static::addInfo('instantiable',true);
    }
    
}
