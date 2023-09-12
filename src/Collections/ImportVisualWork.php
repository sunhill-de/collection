<?php

/**
 * @file ImportVisualWork.php
 * Provides informations about a visual work to be imported
 * Lang en
 * Reviewstatus: 2023-09-11
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Collections;

use Sunhill\ORM\Objects\Collection;
use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyVarchar;
use Sunhill\ORM\Properties\PropertyObject;

/**
 * The class for events
 *
 * @author lokal
 */
class ImportVisualWork extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->object('imported_to')
             ->setAllowedClass('VisualWork')
             ->set_editable(false)
             ->set_groupeditable(false)
             ->set_displayable(true)
             ->set_description('Was this work already imported');
        $list->varchar('title')
             ->set_editable(false)
             ->set_groupeditable(false)
             ->set_displayable(true)
             ->set_description('The title of the visual work (title of movie, series, episode)');
    }
    
   protected static function setupInfos()
	{
		static::addInfo('name','ImportVisualWork');
		static::addInfo('table','importvisualworks');
      	static::addInfo('name_s','import visual work',true);
       	static::addInfo('name_p','import visual works',true);
       	static::addInfo('description','Stores information about a visual work to be imported', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
		static::addInfo('import', true);
	}

}
