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
namespace Sunhill\Collection\Objects\Properties;

use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for properties
 *
 * @author lokal
 *        
 */
class Property extends ORMObject
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('name')
            ->setMaxLen(100)
            ->set_description('The name of the property')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        $list->object('owner')
            ->setAllowedClasses('FamilyMember')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->enum('ingress_kind')        
            ->setEnumValues(['made','bought','present','swap'])
            ->setDefault('bought')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->date('ingress_date')
            ->searchable()
            ->setDefault(null)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->float('ingress_price')
            ->searchable()
            ->setDefault(null)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->object('ingress_source')
            ->setAllowedClasses(['Shop','Person'])
            ->searchable()
            ->setDefault(null)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->object('location')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setAllowedClasses('Location');
        $list->enum('egress_kind')
            ->searchable()
            ->setDefault(null)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setEnumValues(['trash','sold','lost','present','swap']);
        $list->date('egress_date')
            ->searchable()
            ->setDefault(null)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->float('egress_price')
            ->searchable()
            ->setDefault(null)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);            
        $list->enum('type')
            ->searchable()
            ->setDefault('physical')
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
