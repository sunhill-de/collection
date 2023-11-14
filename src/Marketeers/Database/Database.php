<?php
/**
 * @file CPU.php
 * Provides information about the cpu
 * Lang en
 * Reviewstatus: 2021-10-30
 * Localization: none
 * Documentation: complete
 * Tests:
 * Coverage: unknown
 * Dependencies: none
 * PSR-State: complete
 */

namespace Sunhill\Collection\Marketeers\Database;

use Sunhill\ORM\InfoMarket\Marketeer;
use Sunhill\Basic\Base;

class Database extends Marketeer
{
    
    public function __construct()
    {
        parent::__construct();
        $this->setName('database');
        $this->addEntry('classes', ClassesItem::class);
/*        $this->addEntry('collections', CollectionsItem::class);        
        $this->addEntry('objects', ObjectsItem::class);
        $this->addEntry('tags', TagsItem::class);
        $this->addEntry('attributes', AttributesItem::class); */
    }
    
    
}
