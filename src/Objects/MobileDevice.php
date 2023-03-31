<?php

/**
 * @file MobileDevice.php
 * Provides the MobileDevice object
 * Lang en
 * Reviewstatus: 2022-03-18
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\Crawler\Facades\FileManager;

/**
 * The class for mobile phones. 
 *
 * @author lokal
 *        
 */
class MobileDevice extends NetworkDevice 
{


    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('operating_system')
            ->setMaxLen(40)
            ->searchable()
            ->set_description('What OS is running.')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        self::varchar('phone_number')
            ->setMaxLen(40)
            ->searchable()
            ->set_description('The phone number')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
    }
 
    protected static function setupInfos()
    {
        static::addInfo('name','MobileDevice');
        static::addInfo('table','mobiledevices');
        static::addInfo('name_s','mobile device',true);
        static::addInfo('name_p','mobile devices',true);
        static::addInfo('description','Informations about a mobile device', true);
        static::addInfo('options',0);
        static::addInfo('editable',true);
        static::addInfo('instantiable',true);
    }
    
}
