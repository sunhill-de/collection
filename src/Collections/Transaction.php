<?php

/**
 * @file Transaction.php
 * Provides informations about transactions. (like "An article was bought at Amazon")
 * Lang en
 * Reviewstatus: 2022-09-2
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies: ORMObject
 */
namespace Sunhill\Collection\Objects;

use Sunhill\ORM\Objects\Collection;
use Sunhill\ORM\Objects\PropertyList;
use Sunhill\ORM\Properties\PropertyObject;
use Sunhill\ORM\Properties\PropertyVarchar;

/**
 * The class for transactions
 *
 * @author lokal
 *        
 */
class Transaction extends Collection
{
    
    protected static function setupProperties(PropertyList $list)
    {
        $list->varchar('order_id')
            ->setMaxLen(100)
            ->set_description('The order id from the shop')
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(false)
            ->searchable();
        $list->object('shop')
            ->set_description('Where did the transaction take place')
            ->setAllowedObjects('Shop')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->date('order_date')
            ->set_description('When was the order ordered')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->date('delivery_date')
            ->set_description('When was the order delivered')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->float('amount')
            ->set_description('The total amount of this order')
            ->searchable()
            ->set_editable(true)
            ->set_groupeditable(true)
            ->set_displayable(true);
        $list->array('articles')
            ->setElementType(PropertyObject::class)
            ->setAllowedObject('Property')
            ->set_description('Articles of this order that are properties')
            ->searchable()
            ->set_displayable(true)
            ->set_editable(true)
            ->set_groupeditable(true); 
        $list->array('other_articles')
            ->setElementType(PropertyVarchar::class)
            ->set_description('Articles that are not properties')
            ->set_editable(true)
            ->set_groupeditable(true);            
    }
    
    protected static function setupInfos()
	{
		static::addInfo('name','Transaction');
		static::addInfo('table','transactions');
      	static::addInfo('name_s','transaction',true);
       	static::addInfo('name_p','transactions',true);
       	static::addInfo('description','Informations about a transaction', true);
       	static::addInfo('options',0);
		static::addInfo('editable',true);
		static::addInfo('instantiable',true);
	}
}
