<?php

/**
 * @file CreativeCollection.php
 * Provides informations about a creative collection. A collection is not a standalone work like a 
 * book or movie but a concept of collecting these standalone works (like a cd-series, a book series, 
 * a movie series or a TV_series)
 * Lang en
 * Reviewstatus: 2023-09-12
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects\Creative;

use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for creative works
 *
 * @author lokal
 *        
 */
class CreativeCollection extends CreativeWork
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->integer('item_count')
        ->set_description('How many items belong to this collection')
        ->setDefault(null)
        ->searchable()
        ->set_editable(true)
        ->set_groupeditable(false)
        ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','CreativeCollection');
		static::addInfo('table','creativecollections');
       	static::addInfo('name_s','creative collection',true);
       	static::addInfo('name_p','creative collections',true);
       	static::addInfo('description','Informations about a collection of creative works', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',false);
		static::addInfo('table_columns',['name','original_name']);
		static::addInfo('keyfield',':name');
    }
}
