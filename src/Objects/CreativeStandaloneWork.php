<?php

/**
 * @file CreativeWork.php
 * Provides informations about a creative Work
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
 * The class for creative works
 *
 * @author lokal
 *        
 */
class CreativeStandaloneWork extends CreativeWork
{
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::date('release_date')
            ->set_description('When was this work released')
            ->setDefault(null)
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true);
        self::ArrayOfObjects('staff')
            ->setDescription('What persons worked on this work.')
            ->setAllowedObject('Staff')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
        self::ArrayOfObjects('countries')
            ->set_description('The origin countries of this work')
            ->setAllowedObject('Country')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
       self::object('language')
            ->set_description('What is the original language of this work')
            ->setAllowedObject('Language')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
       self::ArrayOfStrings('keywords')
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
