<?php

/**
 * @file Movie.php
 * Provides informations about a movie 
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Collections;

use Sunhill\ORM\Objects\Collection;
use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for movies
 *
 * @author lokal
 *        
 */
class Staff extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->object('person')
            ->setAllowedClasses('Person')
            ->set_description('Link to the person')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        $list->collection('job')
            ->setAllowedCollection('StaffJob')
            ->set_description('What was the job of the person')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        $list->varchar('additional')
            ->set_description('Additional informations (like name of the role of actors)')
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','Staff');
		static::addInfo('table','staffs');
        static::addInfo('name_s','staff',true);
        static::addInfo('name_p','staff',true);
        static::addInfo('description','Stores informations about staff', true);
        static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	
		static::addInfo('table_columns',['person'=>'person->keyfield','job'=>'job->name','additional']);
		static::addInfo('keyfield',':person->keyfield additional?(:additional)');
  }
}
