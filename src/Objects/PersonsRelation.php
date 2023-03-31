<?php

/**
 * @file PersonsRelation.php
 * Provides informations about a relation between two persons
 * Lang en
 * Reviewstatus: 2022-08-29
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
class PersonsRelation extends ORMObject
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::object('person1')
            ->setAllowedObjects('Person')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::object('person2')
            ->setAllowedObjects('Person')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::enum('relation')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setEnumValues(['marriage','relation','divorce']);
        self::date('relation_date')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','PersonrRlation');
		static::addInfo('table','personrelations');
      	static::addInfo('name_s','person relation',true);
       	static::addInfo('name_p','person relations',true);
       	static::addInfo('description','Class for relation between two persons', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}

}
