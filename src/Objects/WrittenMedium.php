<?php

/**
 * @file WrittenMedium.php
 * Provides informations about a WrittenMedium (e.g. Book)
 * Lang en
 * Reviewstatus: 2022-08-30
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for 
 *
 * @author lokal
 *        
 */
class WrittenMedium extends Medium
{
    public static $table_name = 'writtenmediums';
    
    public static $object_infos = [
        'name'=>'WrittenMedium',       // A repetition of static:$object_name @todo see above
        'table'=>'writtenmediums',     // A repitition of static:$table_name
        'name_s' => 'written medium',
        'name_p' => 'written mediums',
        'description' => 'Informations about a written medium (e.g. book)',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::enum('media_type')        
            ->set_description('What kind of media is this')
            ->setEnumValues(['soft-cover', 'hard-cover', 'magazine', 'other'])
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::integer('pages')
            ->set_description('The number of pages')
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::arrayOfObjects('written_works')
            ->setAllowedObject('WrittenWork')
            ->set_description('What written works are in this medium')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true); 
        self::calculated('ISBN')
            ->searchable();
    }
    
    protected function calculate_ISBN()
    {
    }
  
    protected static function setupInfos()
	  {
		    static::addInfo('name','WrittenMedium');
		    static::addInfo('table','writtenmediums');
      	static::addInfo('name_s','written medium',true);
       	static::addInfo('name_p','written mediums',true);
       	static::addInfo('description','Informations about a written medium (e.g. book)');
       	static::addInfo('options',0);
		    static::addInfo('editable',true);
		    static::addInfo('instantiable',true);
	  }
}
