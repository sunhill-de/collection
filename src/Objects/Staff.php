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
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for movies
 *
 * @author lokal
 *        
 */
class Staff extends ORMObject
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::object('person')
            ->set_description('Link to the person')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        self::varchar('job')
            ->set_description('What was the job of the person')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        self::varchar('additional')
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
	}
}
