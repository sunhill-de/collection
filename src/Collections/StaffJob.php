<?php

/**
 * @file StaffJob.php
 * Provides informations about a movie 
 * Lang en
 * Reviewstatus: 2023-09-13
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
class StaffJob extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('name')
            ->set_description('What was the job of the person')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true)
            ->set_sortable(true);
    }
    
  protected static function setupInfos()
	{
		static::addInfo('name','StaffJob');
		static::addInfo('table','staffjobs');
        static::addInfo('name_s','staff job',true);
        static::addInfo('name_p','staff jobs',true);
        static::addInfo('description','Stores informations about staff jobs', true);
        static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	
		static::addInfo('table_columns',['name']);
		static::addInfo('keyfield',':name');
  }
}
