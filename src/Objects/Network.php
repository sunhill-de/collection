<?php

/**
 * @file Network.php
 * Providesthe Network object that describes a enclosed network
 * Lang en
 * Reviewstatus: 2022-08-28
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for network
 *
 * @author lokal
 *        
 */
class Network extends ORMObject
{
    public static $table_name = 'networks';
    
    public static $object_infos = [
        'name'=>'Network',       // A repetition of static:$object_name @todo see above
        'table'=>'networks',     // A repitition of static:$table_name
        'name_s' => 'network',
        'name_p' => 'networks',
        'description' => 'Class for networks',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('name')
            ->setMaxLen(100)
            ->set_description('The name of the network')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        self::varchar('prefix')
            ->setMaxLen(20)
            ->set_description('The network prefix (e.g. 192.168.3)')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        self::varchar('description')
            ->set_description('A more verbose description of the network')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        self::object('part_of')
            ->setAllowedObjects(['Network'])
            ->set_description('If this network is part of a larger network')
            ->set_displayable(true)
            ->set_editable(false)
            ->set_groupeditable(true);
    }
    
      protected static function setupInfos()
	{
		static::addInfo('name','Network');
		static::addInfo('table','networks');
       	static::addInfo('name_s','network',true);
       	static::addInfo('name_p','networks',true);
       	static::addInfo('description','Informations about a network');
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}

}
