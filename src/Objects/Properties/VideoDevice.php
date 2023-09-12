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
namespace Sunhill\Collection\Objects\Properties;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for Video cameras. 
 *
 * @author lokal
 *        
 */
class VideoDevice extends NetworkDevice {

    protected static function setupProperties(PropertyList $list)
    {
       $list->enum('primary_stream_type')
            ->set_description('What kind of stream is the primary')
            ->setEnumValues(['rtst','mpeg','image'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->varchar('primary_stream_path')
            ->setMaxLen(80)
            ->set_description('The path to the primary stream')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        $list->enum('secondary_stream_type')
            ->set_description('What kind of stream is the secondary')
            ->setEnumValues(['rtst','mpeg','image'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->varchar('secondary_stream_path')
            ->setMaxLen(80)
            ->set_description('The path to the secondary stream')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        $list->integer('monitor_1')
            ->set_description('Number of first monitor')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        $list->integer('monitor_2')
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
        static::addInfo('description','Informations about a video device', true);
        static::addInfo('options',0);
        static::addInfo('editable',true);
        static::addInfo('instantiable',true);
    }
    
}
