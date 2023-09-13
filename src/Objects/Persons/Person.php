<?php

/**
 * @file Person.php
 * Provides informations about a person
 * Lang en
 * Reviewstatus: 2022-08-28
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects\Persons;

use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyVarchar;

/**
 * The class for persons
 *
 * @author lokal
 *        
 */
class Person extends ORMObject
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('firstname')
            ->setMaxLen(100)
            ->set_description('The first name of the person')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        $list->varchar('middlename')
            ->setMaxLen(100)
            ->setDefault('')
            ->set_description('The middle name of the person')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        $list->varchar('lastname')
            ->setMaxLen(100)
            ->set_description('The last name of the person')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->searchable();
        $list->varchar('title')
            ->setMaxLen(50)
            ->setDefault('')
            ->set_description('The title of the person')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false);
        $list->enum('sex')
            ->setEnumValues(['male','female','divers'])
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_description('Sex of this person');
        $list->array('groups')
            ->setElementType(PropertyVarchar::class)
            ->set_description('What user groups is this person member of')
            ->set_editable(true)
            ->set_groupeditable(true);            
        $list->array('aliases')
            ->setElementType(PropertyVarchar::class)
            ->set_description('Other names for this person')
            ->set_editable(true)
            ->set_groupeditable(true);            
    }
  
    protected static function setupInfos()
	{
		static::addInfo('name','Person');
		static::addInfo('table','persons');
       	static::addInfo('name_s','person',true);
       	static::addInfo('name_p','persons',true);
       	static::addInfo('description','Informations about a person', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);

		static::addInfo('table_columns',['firstname','lastname','sex']);
		static::addInfo('keyfield',':firstname :lastname');
		
    }
    
}
