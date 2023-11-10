<?php

/**
 * @file PersonsRelation.php
 * Provides informations about a relation between two persons
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
 * The class for properties
 *
 * @author lokal
 *        
 */
class PersonsRelation extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->object('person1')
            ->set_description('The 1. person')
            ->setAllowedClasses('Person')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->object('person2')
            ->set_description('The 2. person')
            ->setAllowedClasses('Person')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->enum('relation')
            ->set_description('The relation between these persons')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true)
            ->setEnumValues(['marriage','relation','divorce'])
            ->set_sortable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','PersonsRelation');
		static::addInfo('table','personrelations');
      	static::addInfo('name_s','person relation',true);
       	static::addInfo('name_p','person relations',true);
       	static::addInfo('description','Class for relation between two persons', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		static::addInfo('table_columns',['person1'=>'person1->keyfield','person2'=>'person2->keyfield','relation']);
		static::addInfo('keyfield',':relation :person1->keyfield & :person2->keyfield');
    }

}
