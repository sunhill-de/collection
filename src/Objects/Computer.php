<?php

/**
 * @file Computer.php
 * Provides informations about a computer
 * Lang en
 * Reviewstatus: 2022-03-17
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

/**
 * The class for computers
 *
 * @author lokal
 *        
 */
class Computer extends NetworkDevice
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::enum('computer_type')
            ->set_description('What kind of computer is this')
            ->setEnumValues(['server','laptop','tablet','standalone'])
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true)
            ->searchable();
        self::varchar('operating_system')
            ->set_description('What OS runs it')
            ->setMaxLen(100)
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Computer');
		static::addInfo('table','computers');
       	static::addInfo('name_s','computer',true);
       	static::addInfo('name_p','computers',true);
       	static::addInfo('description','Informations about a computer', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
