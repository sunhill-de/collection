<?php

/**
 * @file ElectronicDevice.php
 * Provides informations about an electronic Device
 * Lang en
 * Reviewstatus: 2022-03-17
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyVarchar;

/**
 * The class for properties
 *
 * @author lokal
 *        
 */
class ElectronicDevice extends Property
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->enum('power_supply')
            ->set_description('How this device is powered')
            ->setEnumValues(['plug','AA','AAA','Baby','Mono','Akku','9V','other','none'])
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->searchable();
        $list->object('manufacturer')
            ->setAllowedClass(['Manufacturer'])
            ->set_description('Which company made this device')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->varchar('model_name')
            ->set_description('Whats the model name of this device')
            ->setMaxLen(100)
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->array('device_groups')
            ->setElementType(PropertyVarchar::class)
            ->set_description('Which device groups does this device belong to')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','ElectronicDevice');
		static::addInfo('table','electronicdevices');
       	static::addInfo('name_s','electronic device',true);
       	static::addInfo('name_p','electronic devices',true);
       	static::addInfo('description','Informations about a electronic device', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}

}
