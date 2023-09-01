<?php

/**
 * @file Server.php
 * Provides informations about a Server
 * Lang en
 * Reviewstatus: 2022-09-1
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for Servers
 *
 * @author lokal
 *        
 */
class Server extends NetworkDevice
{
    
    protected static function setupProperties(PropertyList $list)
    {
        self::varchar('description')
            ->set_description('What is the purpose of this server')
            ->setMaxLen(100)
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Server');
		static::addInfo('table','servers');
       	static::addInfo('name_s','server',true);
       	static::addInfo('name_p','servers',true);
       	static::addInfo('description','Informations about a Server', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
