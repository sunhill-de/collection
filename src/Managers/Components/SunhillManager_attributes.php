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
use Sunhill\Collection\Exceptions\InvalidIDException;

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
    
    public function getAttribute(int $id)
    {
        if (empty($attribute = Attributes::query()->where('id','=',$id)->first())) {
            throw new InvalidIDException("The given 'id' is invalid.");
        }
        $hilf = explode('|',$attribute->allowed_classes);
        $hilf = array_slice($hilf,1,-1);
        $attribute->allowed_classes = $hilf; 
        return $attribute;
    }
    
    public function addAttribute(string $name, string $type, array $allowed_classes)
    {
        
    }
    
    public function updateAttribute(int $id, string $name, string $type, array $allowed_classes)
    {
        
    }
    
}