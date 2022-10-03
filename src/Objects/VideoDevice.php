<?php

/**
 * @file VideoDevice.php
 * Provides the VideoDevice object
 * Lang en
 * Reviewstatus: 2022-03-18
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Objects\Objects;

use Sunhill\Crawler\Facades\FileManager;

/**
 * The class for Video cameras. 
 *
 * @author lokal
 *        
 */
class VideoDevice extends NetworkDevice {

    public static $table_name = 'videodevices';

    public static $object_infos = [
        'name'=>'VideoDevice',       // A repetition of static:$object_name @todo see above
        'table'=>'videodevices',     // A repitition of static:$table_name
        'name_s' => 'video device',
        'name_p' => 'video devices',
        'description' => 'Class for video devices',
        'options'=>0,           // Reserved for later pu40rposes
    ];

    protected static function setupProperties()
    {
        parent::setupProperties();
        
        self::enum('primary_stream_type')
            ->set_description('What kind of stream is the primary')
            ->setEnumValues(['rtst','mpeg','image'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::varchar('primary_stream_path')
            ->setMaxLen(80)
            ->set_description('The path to the primary stream')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        self::enum('secondary_stream_type')
            ->set_description('What kind of stream is the secondary')
            ->setEnumValues(['rtst','mpeg','image'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::varchar('secondary_stream_path')
            ->setMaxLen(80)
            ->set_description('The path to the secondary stream')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        self::integer('monitor_1')
            ->set_description('Number of first monitor')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        self::integer('monitor_2')
            ->set_description('Number of second monitor')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
    }
 
    protected static function setupInfos()
    {
        static::addInfo('name','VideoDevice');
        static::addInfo('table','videodevices');
        static::addInfo('name_s','video device',true);
        static::addInfo('name_p','video devices',true);
        static::addInfo('description','Informations about a video device');
        static::addInfo('options',0);
        static::addInfo('editable',true);
        static::addInfo('instantiable',true);
    }
    
}
