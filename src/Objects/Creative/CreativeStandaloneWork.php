<?php

/**
 * @file CreativeStandaloneWork.php
 * Provides informations about a standaonle creative work. This could be a book, album, song, movie, episode 
 * Lang en
 * Reviewstatus: 2022-08-29
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects\Creative;

use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyCollection;
use Sunhill\ORM\Properties\PropertyObject;
use Sunhill\ORM\Properties\PropertyVarchar;

/**
 * The class for creative works
 *
 * @author lokal
 *        
 */
class CreativeStandaloneWork extends CreativeWork
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->date('release_date')
            ->set_description('When was this work released')
            ->setDefault(null)
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true);
        $list->array('staff')
            ->setElementType(PropertyCollection::class)
            ->set_description('What persons worked on this work.')
            ->setAllowedClass('Staff')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        $list->array('countries')
            ->setElementType(PropertyObject::class)
            ->set_description('The origin countries of this work')
            ->setAllowedClasses('Country')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
       $list->collection('language')
            ->set_description('What is the original language of this work')
            ->setAllowedCollection('Language')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
       $list->array('keywords')
            ->setElementType(PropertyVarchar::class)
            ->set_description('What are the keywords to this work')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','CreativeStandaloneWork');
		static::addInfo('table','creativestandaloneworks');
       	static::addInfo('name_s','creative standalone work',true);
       	static::addInfo('name_p','creative standalone works',true);
       	static::addInfo('description','Informations about a single creative work', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
