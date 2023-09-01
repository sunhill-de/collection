<?php

/**
 * @file Friend.php
 * Provides informations about a friend (a person that we want to know more informations about)
 * Lang en
 * Reviewstatus: 2022-02-28
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: Person
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\PropertyList;

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
        self::date('date_of_birth')
            ->set_description('The birthday of this person')
            ->setDefault(null)
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::date('date_of_death')
            ->set_description('The deathday of this person')
            ->setDefault(null)
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::varchar('birth_name')
            ->setMaxLen(100)
            ->setDefault(null)
            ->set_description('The birth name of the person')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::object('address')
            ->setAllowedObjects('Address')
            ->setDefault(null)
            ->set_description('The address of this person')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::arrayOfStrings('friendgroups')
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
	}
}
