<?php
/**
 * @file SunhillManager_classes.php
 * A trait for better overview that deals with handling of classes
 * Lang en
 * Reviewstatus: 2023-09-13
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies:
 */

namespace Sunhill\Collection\Managers\Components;

use Sunhill\ORM\Objects\PropertiesCollection;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Properties\Utils\DefaultNull;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Facades\Attributes;

trait SunhillManager_attributes
{
    
    protected function handleAttributesConditions($query, array $conditions)
    {
        foreach ($conditions as $condition) {
            
        }
        return $query;
    }
    
    public function getAttributesCount(array $conditions = [])
    {
        $query = Attributes::query();
        $query = $this->handleAttributesConditions($query, $conditions);
        return $query->count();
    }

    public function getAttributesList(array $conditions = [], string $order, string $order_dir = 'desc', int $offset = 0, int $limit = 10)
    {
        $query = Attributes::query();
        $query = $this->handleAttributesConditions($query, $conditions);
        if ($offset) {
            $query->offset($offset);
        }
        if ($limit) {
            $query->limit($limit);
        }
        $query->orderBy($order, $order_dir);
        return $query->get();
    }
    
}