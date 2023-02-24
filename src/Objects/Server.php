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
namespace Sunhill\Objects\Objects;

/**
 * The class for Servers
 *
 * @author lokal
 *        
 */
class Server extends NetworkDevice
{
    public static $table_name = 'servers';
    
    public static $object_infos = [
        'name'=>'Server',       // A repetition of static:$object_name @todo see above
        'table'=>'servers',     // A repitition of static:$table_name
        'name_s' => 'server',
        'name_p' => 'servers',
        'description' => 'Class for Servers',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
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
       	static::addInfo('description','Informations about a Server');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
