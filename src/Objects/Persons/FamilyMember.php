<?php

/**
 * @file FamilyMember.php
 * Provides the FamilyMember object
 * Lang en
 * Reviewstatus: 2023-09-12
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: fileobject
 */
namespace Sunhill\Collection\Objects\Persons;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for FamilyMembers
 *
 * @author lokal
 *        
 */
class FamilyMember extends Friend
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->time('time_of_birth')
            ->setDefault(null)
            ->set_description('When was this person born')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
         $list->object('place_of_birth')
            ->setDefault(null)
            ->setAllowedClasses('Location')
            ->set_description('Where was this person born')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true);
       $list->object('mother')
            ->setDefault(null)
            ->set_description('Who is the mother')
            ->setAllowedClasses('FamilyMember')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true);
        $list->object('father')
            ->setDefault(null)
            ->set_description('Who is the father')
            ->setAllowedClasses('FamilyMember')
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
       	static::addInfo('description','Informations about a family member', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		static::addInfo('table_columns',['firstname','lastname','sex']);
		static::addInfo('keyfield',':firstname :lastname');
    }
}
