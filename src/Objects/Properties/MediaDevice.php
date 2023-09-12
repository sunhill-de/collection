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
namespace Sunhill\Collection\Objects\Properties;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for media devices
 *
 * @author lokal
 *        
 */
class MediaDevice extends NetworkDevice
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->enum('media_type')
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
        static::addInfo('description','Informations about a media device', true);
        static::addInfo('options',0);
        static::addInfo('editable',true);
        static::addInfo('instantiable',true);
    }
    
}
