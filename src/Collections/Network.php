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
namespace Sunhill\Collection\Collections;

use Sunhill\ORM\Objects\Collection;
use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for network
 *
 * @author lokal
 *        
 */
class Network extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('name')
            ->setMaxLen(100)
            ->set_description('The name of the network')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable()
            ->set_sortable(true);
        $list->varchar('prefix')
            ->setMaxLen(20)
            ->set_description('The network prefix (e.g. 192.168.3)')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true)
            ->set_sortable(true);
        $list->varchar('description')
            ->set_description('A more verbose description of the network')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        $list->collection('part_of')
            ->setAllowedCollection('Network')
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
       	static::addInfo('description','Informations about a network', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		
		static::addInfo('table_columns',['name','prefix','part_of'=>'part_of->name','description']);
		static::addInfo('keyfield',':name');
		
	}

}
