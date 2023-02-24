<?php

/**
 * @file FamilyMember.php
 * Provides the FamilyMember object
 * Lang en
 * Reviewstatus: 2022-28-02
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: fileobject
 */
namespace Sunhill\Collection\Objects;

/**
 * The class for FamilyMembers
 *
 * @author lokal
 *        
 */
class FamilyMember extends Friend
{
    public static $table_name = 'familymembers';
    
    public static $object_infos = [
        'name'=>'FamilyMember',       // A repetition of static:$object_name @todo see above
        'table'=>'familymembers',     // A repitition of static:$table_name
        'name_s' => 'family member',
        'name_p' => 'family members',
        'description' => 'Class for family members',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::time('time_of_birth')
            ->setDefault(null)
            ->set_description('When was this person born')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
         self::object('place_of_birth')
            ->setDefault(null)
            ->setAllowedObjects('Location')
            ->set_description('Where was this person born')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true);
       self::object('mother')
            ->setDefault(null)
            ->set_description('Who is the mother')
            ->setAllowedObjects('FamilyMember')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true);
        self::object('father')
            ->setDefault(null)
            ->set_description('Who is the father')
            ->setAllowedObjects('FamilyMember')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true);
    }
 
    protected static function setupInfos()
	{
		static::addInfo('name','FamilyMember');
		static::addInfo('table','familymembers');
       	static::addInfo('name_s','family member',true);
       	static::addInfo('name_p','family members',true);
       	static::addInfo('description','Informations about a family member');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
