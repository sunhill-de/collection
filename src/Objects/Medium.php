<?php

/**
 * @file Medium.php
 * Provides informations about a medium. A medium is any kind of storage for at least one CreativeWork.
 * For example the blu-ray "Matrix" (medium) stores the movie "matrix" (CreativeWork)
 * Lang en
 * Reviewstatus: 2022-08-30
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for mediums
 *
 * @author lokal
 *        
 */
class Medium extends Property
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('ean')
            ->set_description('What is the EAN of this medium')
            ->setMaxLen(20)
            ->setDefault(null)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->object('genre')
            ->set_description('What genre does this medium belong to')
            ->setAllowedObjects(['Genre'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->date('released')
            ->set_description('When was this medium released')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);	    
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Medium');
		static::addInfo('table','mediums');
       	static::addInfo('name_s','medium',true);
       	static::addInfo('name_p','mediums',true);
       	static::addInfo('description','Informations about a medium', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
