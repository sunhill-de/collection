<?php

/**
 * @file Genre.php
 * Provides informations about a genre
 * Lang en
 * Reviewstatus: 2022-03-17
 * Localization: unknown
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Objects\Objects;

use Sunhill\ORM\Objects\ORMObject;

/**
 * The class for mediums
 *
 * @author lokal
 *        
 */
class Mime extends ORMObject
{
    public static $table_name = 'mimes';
    
    public static $object_infos = [
        'name'=>'Mime',       // A repetition of static:$object_name @todo see above
        'table'=>'mimes',     // A repitition of static:$table_name
        'name_s' => 'mime',
        'name_p' => 'mimes',
        'description' => 'Class for mime type',
        'options'=>0,           // Reserved for later purposes
    ];
    
    protected static function setupProperties()
    {
        parent::setupProperties();
        self::varchar('mimegroup')
            ->set_description('The main group of the mime')
            ->setMaxLen(40)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::varchar('item')
            ->set_description('The sub group of the mime')
            ->setMaxLen(40)
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        self::varchar('default_ext')
            ->set_description('The default extension for this mime')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);            
        self::object('alias_for')
            ->set_description('The mime this mime is an alias to')
            ->setAllowedObjects(['Mime'])
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
    }
    
    /**
     * Sets up the additional informations
     */
    protected static function setupInfos()
    {
        static::addInfo('name','Mime');
        static::addInfo('table','mimes');
        static::addInfo('name_s','mime',true);
        static::addInfo('name_p','mimes',true);
        static::addInfo('description','Stores mime types',true);
        static::addInfo('options',0);
        static::addInfo('editable',true);
        static::addInfo('instantiable',true);
    }
    
    
}
