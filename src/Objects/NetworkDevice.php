<?php

/**
 * @file NetworkDevice.php
 * Provides the NetworkDevice object
 * Lang en
 * Reviewstatus: 2022-03-18
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for network devices. 
 *
 * @author lokal
 *        
 */
class NetworkDevice extends ElectronicDevice 
{

    protected static function setupProperties(PropertyList $list)
    {
        self::object('network')
            ->setAllowedObjects(['Network'])
            ->setDefault(null)
            ->set_description('What network does this device belong to')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        self::varchar('mac_address')
            ->setMaxLen(40)
            ->searchable()
            ->set_description('The MAC address of this device.')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        self::varchar('network_identifier')
            ->setMaxLen(100)
            ->searchable()
            ->set_description('The network identifier')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        self::integer('pingable')
            ->set_description('Is this device pingable')
            ->setDefault(1)
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true);
        self::varchar('ip4_address')
            ->setMaxLen(15)
            ->set_description('What is the ip4 address of this device')
            ->setDefault(null) // default no address
            ->set_displayable(true)
            ->set_editable(false)
            ->set_groupeditable(false);
        self::varchar('ip6_address')
            ->setMaxLen(17)
            ->set_description('What is the ip6 address of this device')
            ->setDefault(null) // default no address
            ->set_displayable(true)
            ->set_editable(false)
            ->set_groupeditable(false);
    }

    protected static function setupInfos()
	{
		static::addInfo('name','NetworkDecive');
		static::addInfo('table','networkdevices');
      	static::addInfo('name_s','network device',true);
       	static::addInfo('name_p','network devices',true);
       	static::addInfo('description','Stores informationen about network devices', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}

}
