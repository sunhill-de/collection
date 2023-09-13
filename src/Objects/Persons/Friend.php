<?php

/**
 * @file Friend.php
 * Provides informations about a friend (a person that we want to know more informations about)
 * Lang en
 * Reviewstatus: 2023-09-12
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Person
 */
namespace Sunhill\Collection\Objects\Persons;

use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyVarchar;

/**
 * The class for friends
 *
 * @author lokal
 *        
 */
class Friend extends Person
{

    protected static function setupProperties(PropertyList $list)
    {
        $list->date('date_of_birth')
            ->set_description('The birthday of this person')
            ->setDefault(null)
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        $list->date('date_of_death')
            ->set_description('The deathday of this person')
            ->setDefault(null)
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        $list->varchar('birth_name')
            ->setMaxLen(100)
            ->setDefault(null)
            ->set_description('The birth name of the person')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        $list->object('address')
            ->setAllowedClasses('Address')
            ->setDefault(null)
            ->set_description('The address of this person')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        $list->array('friendgroups')
            ->setElementType(PropertyVarchar::class)
            ->set_description('What friend groups is this person member of');
    }

    protected static function setupInfos()
	{
		static::addInfo('name','Friend');
		static::addInfo('table','friends');
       	static::addInfo('name_s','friend',true);
       	static::addInfo('name_p','friends',true);
       	static::addInfo('description','Informations about a friend',true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		static::addInfo('table_columns',['firstname','lastname','sex']);
		static::addInfo('keyfield',':firstname :lastname');
    }
}
