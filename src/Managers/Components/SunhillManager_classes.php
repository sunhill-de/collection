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

trait SunhillManager_classes
{
    
    protected function handleClassesConditions($query, array $conditions)
    {
        foreach ($conditions as $condition) {
            
        }
        return $query;
    }
    
    public function getClassCount(array $conditions = [])
    {
        $query = Classes::query();
        $query = $this->handleClassesConditions($query, $conditions);
        return $query->count();
    }

    public function getClassList(array $conditions = [], string $order, string $order_dir = 'desc', int $offset = 0, int $limit = 10)
    {
        $query = Classes::query();
        $query = $this->handleClassesConditions($query, $conditions);
        if ($offset) {
            $query->offset($offset);
        }
        if ($limit) {
            $query->limit($limit);
        }
        $query->orderBy($order, $order_dir);
        return $query->get();
    }
    
    public function getClassListParameters(array $conditions = [], string $order, string $order_dir = 'desc', int $offset = 0, int $limit = 10)
    {
        
    }
    
    protected function getClassParent(string $namespace)
    {
        if ($namespace::getInfo('name') == 'object') {
            return '';
        } 
        return get_parent_class($namespace)::getInfo('name');
    }
    
    protected function getObjectCount(string $namespace)
    {
        return $namespace::search()->count();    
    }
    
    protected function getType(string $type)
    {
        $parts = explode('\\',$type);
        return substr(array_pop($parts),8);
    }
    
    protected function getClassProperties(string $namespace)
    {
        $properties = $namespace::staticPropertyQuery()->get();
        foreach ($properties as $property) {
            $property->class = isset($property->owner)?$property->owner::getInfo('name'):'';
            if (!isset($property->description)) {
                $property->description = '';
            }
            if (!isset($property->displayable)) {
                $property->displayable = '';
            }
            if (!isset($property->editable)) {
                $property->editable = '';
            }
            if (!isset($property->groupeditable)) {
                $property->groupeditable = '';
            }
            if ($property->default == DefaultNull::class) {
                $property->default = 'NULL';
            }
            $property->semantic = $property->semantic::getName();
            $property->unit = $property->unit::getName();
            $property->type = $this->getType($property->type);
            switch ($property->type) {
                case 'Varchar':
                    $property->additional = __('Maximum length: :maxlen', ['maxlen'=>$property->max_len]);
                    break;
                case 'Array':
                case 'Map':
                    $property->additional = __('Element type: :element',['element'=>$this->getType($property->element_type)]);
                    break;
                case 'Object':
                    $property->additional = __('Allowed class: ');
                    $first = true;
                    if (is_array($property->allowed_classes)) {
                        foreach ($property->allowed_classes as $class) {
                            $property->additional .= ($first?'':',').$class;
                            $first = false;
                        }
                    } else {
                        $property->additional .= $property->allowed_classes;
                    }
                    break;
                default:
                    $property->additional = '';
            }
        }
        return $properties;
    }
    
    public function getClassInformations(string $classname)
    {
        $namespace = Classes::getNamespaceOfClass($classname);
        $parent = $this->getClassParent($namespace);
        return [
            'namespace'=>$namespace,
            'description'=>$namespace::getInfo('description'),
            'classname'=>$classname,
            'tablename'=>$namespace::getInfo('table'),
            'editable'=>$namespace::getInfo('editable'),
            'instantiable'=>$namespace::getInfo('instantiable'),
            'parent'=>make_link(route('classes.show',$parent),$parent),
            'object_count'=>make_link(route('objects.list',$classname),$this->getObjectCount($namespace)),
            'properties'=>$this->getClassProperties($namespace),
        ];
    }
}