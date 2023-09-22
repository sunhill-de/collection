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

trait SunhillManager_tags
{
    
    protected function handleTagsConditions($query, array $conditions)
    {
        foreach ($conditions as $condition) {
            
        }
        return $query;
    }
    
    public function getTagCount(array $conditions = [])
    {
        $query = Tags::query();
        $query = $this->handleTagsConditions($query, $conditions);
        return $query->count();
    }

    public function getTagList(array $conditions = [], string $order, string $order_dir = 'desc', int $offset = 0, int $limit = 10)
    {
        $query = Tags::query();
        $query = $this->handleTagsConditions($query, $conditions);
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