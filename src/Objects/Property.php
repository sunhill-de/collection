<?php

/**
 * @file Property.php
 * Provides informations about a property
 * Lang en
 * Reviewstatus: 2022-08-28
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for properties
 *
 * @author lokal
 *        
 */
class Property extends ORMObject
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('name')
            ->setMaxLen(100)
            ->set_description('The name of the property')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::object('owner')
            ->setAllowedObjects('FamilyMember')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::enum('ingress_kind')        
            ->setEnumValues(['made','bought','present','swap'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::date('ingress_date')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::float('ingress_price')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::object('ingress_source')
            ->setAllowedObjects(['Shop','Person'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::object('location')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setAllowedObjects('Location');
        self::enum('egress_kind')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setEnumValues(['trash','sold','lost','present','swap']);
        self::date('egress_date')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::float('egress_price')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);            
        self::enum('type')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setEnumValues(['physical','virtual','pseudo']); 
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Property');
		static::addInfo('table','properties');
       	static::addInfo('name_s','property',true);
       	static::addInfo('name_p','properties',true);
       	static::addInfo('description','Informations about a property', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
