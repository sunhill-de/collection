<?php

/**
 * @file KnownNetworkDevice.php
 * Provides informations about all network devices that where found via a scan
 * Lang en
 * Reviewstatus: 2024-04-24
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Collections;

use Sunhill\ORM\Objects\Collection;
use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyVarchar;
use Sunhill\Collection\Objects\Properties\NetworkDevice;

/**
 * The class for languages
 *
 * @author lokal
 *        
 */
class KnownNetworkDevice extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('name')
            ->setMaxLen(100)
            ->set_description('The name of the device')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->setDefault('unnamed device')
            ->searchable()
            ->set_sortable(true);
        $list->varchar('mac')
            ->setMaxLen(20)
            ->set_description('The mac address of the device')
            ->searchable()
            ->set_editable(false)
            ->set_groupeditable(false)
            ->set_displayable(true)
            ->set_sortable(true);
        $list->varchar('manufacturer')
            ->setMaxLen(200)
            ->set_description('The manufacturer of the network device')
            ->searchable()
            ->set_editable(false)
            ->set_groupeditable(false)
            ->set_displayable(true)
            ->set_sortable(true);
       $list->varchar('last_ip')
            ->setMaxLen(15)
            ->set_description('What was the last ip this device was known')
            ->searchable()
            ->set_editable(false)
            ->set_groupeditable(false)
            ->set_displayable(true)           
            ->set_sortable(true);
        $list->datetime('firstseen')
            ->set_description('When was this device first seen')
            ->searchable()
            ->set_editable(false)
            ->set_groupeditable(false)
            ->set_displayable(true)
            ->set_sortable(true);
        $list->datetime('lastseen')
            ->set_description('When was this device last seen')
            ->searchable()
            ->set_editable(false)
            ->set_groupeditable(false)
            ->set_displayable(true)
            ->set_sortable(true);
        $list->object('associated_device')
            ->setAllowedClass(NetworkDevice::class)
            ->set_description('Link to a device if one exists')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true)
            ->set_sortable(true);
    }
    
    protected static function setupInfos()
    {
        static::addInfo('name','KnownNetworkDevice');
        static::addInfo('table','knownnetworkdevices');
        static::addInfo('name_s','Known network device',true);
        static::addInfo('name_p','Known network devices',true);
        static::addInfo('description','A class for collection information of found devices', true);
        static::addInfo('options',0);
        static::addInfo('editable',true);
        static::addInfo('instantiable',true);

        static::addInfo('table_columns',['name','mac','lastseen']);
        static::addInfo('keyfield',':name');        
    }
        
}
