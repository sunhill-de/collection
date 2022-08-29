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
namespace Sunhill\Objects\Objects;

/**
 * The class for friends
 *
 * @author lokal
 *        
 */
class Friend extends Person
{
    public static $table_name = 'friends';
    
    public static $object_infos = [
        'name'=>'Friend',       // A repetition of static:$object_name @todo see above
        'table'=>'friends',     // A repitition of static:$table_name
        'name_s' => 'friend',
        'name_p' => 'friends',
        'description' => 'Class for friends',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::date('date_of_birth')
            ->set_description('The birthday of this person')
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
            ->set_allowedObjects('Address')
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
       	static::addInfo('description','Informations about a friend');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
