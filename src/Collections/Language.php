<?php

/**
 * @file Language.php
 * Provides informations about a language
 * Lang en
 * Reviewstatus: 2024-04-24
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\Collection;
use Sunhill\ORM\Objects\PropertyList;

/**
 * The class for languages
 *
 * @author lokal
 *        
 */
class Language extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('name')
            ->setMaxLen(100)
            ->set_description('The name of the language')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        $list->varchar('iso')
            ->setMaxLen(5)
            ->set_description('the iso code of the language')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(false)
            ->set_displayable(true);
    }
    
    protected static function setupInfos()
    {
        static::addInfo('name','Language');
        static::addInfo('table','languages');
        static::addInfo('name_s','language',true);
        static::addInfo('name_p','languages',true);
        static::addInfo('description','A class for languages', true);
        static::addInfo('options',0);
        static::addInfo('editable',true);
        static::addInfo('instantiable',true);
    }
        
}
