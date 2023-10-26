<?php

namespace Sunhill\Collection\Response\Database\Classes;

use Sunhill\Visual\Response\Crud\SunhillSemiCrudResponse;
use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\Collection\Facades\SunhillManager;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Properties\Utils\DefaultNull;

class ClassesCrudResponse extends SunhillSemiCrudResponse
{
    
    protected static $route_base = 'classes';
    
    protected function getDefaultOrder(): string
    {
        return 'name';
    }
    
    protected function getSearchfields()
    {
        return [
            $this->getStdClass(['value'=>'name','name'=>'name','relations'=>['=','<>','<','<=','>','>=','begins with','ends with','contains']]),
            $this->getStdClass(['value'=>'parent','name'=>'parent','relations'=>['=','<>','<','<=','>','>=','begins with','ends with','contains']]),
        ];    
    }
    
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->column('class')->title('Class name')->searchable('class')->setColumnSortable('class');
        $descriptor->column('name')->title('Name')->searchable('name')->setColumnSortable('name');
        $descriptor->column('description')->title('Description');
        $descriptor->column('parent')->title('Parent');
        $descriptor->column('list')->link('objects.list',['key'=>'name'])->setLinkTitle('list');
        $descriptor->column('add')->link('objects.add',['class'=>'name'])->setLinkTitle('add');
        $descriptor->column('show')->link('classes.show',['id'=>'name'])->setLinkTitle('show');
    }
    
    public function getClassCount(array $conditions = [])
    {
        $query = Classes::query();
        $query = $this->handleClassesConditions($query, $conditions);
        return $query->count();
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        return $this->getClassCount([]);
    }
    
    protected function handleClassesConditions($query, array $conditions)
    {
        foreach ($conditions as $condition) {
            
        }
        return $query;
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
    
    /**
     * Return the classes that fit to the current filter
     * @return unknown
     */
    protected function getData()
    {
        return $this->getClassList([],$this->order, $this->order_dir, $this->offset*self::ENTRIES_PER_PAGE, self::ENTRIES_PER_PAGE);
    }
    
    /**
     * Checks if the given id (in this case classname) exists
     * @param unknown $id
     * @return bool
     */
    protected function IDExists($id): bool
    {
        return !is_null(Classes::searchClass($id));
    }
    
    protected static $entity = 'classes';
    
    
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
    
    protected function getClassInfo($id)
    {
        $class = Classes::getNamespaceOfClass($id);
        $parent = $this->getClassParent($class);
        
        return [
            'caption'=>__("Show class ':classname'", ['classname'=>$id]),
            'header'=>[
                __('Key'),
                __('Value')
            ],
            'data'=>[
                [__('Class name'),$class::getInfo('name')],
                [__('Description'),$class::getInfo('description')],
                [__('Namespace'),$class],
                [__('Table name'),$class::getInfo('table')],
                [__('editable'),$class::getInfo('editable',false)],
                [__('instantiable'),$class::getInfo('instantiable',false)],
                [__('parent'),make_link(route('classes.show',$parent),$parent)],
                [__('object count'),make_link(route('objects.list',$id),$this->getObjectCount($class))],
            ],
            'links'=>[],
        ];
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
            if (isset($property->description)) {
                $property->description = __($property->description);
            } else {
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
        
    protected function getFieldInfo($id)
    {
        $result = [
        'caption'=>__("Show propeties of class ':classname'", ['classname'=>$id]),
            'header'=>[
            __('Name'),
            __('Description'),
            __('Type'),
            __('Class'),
            __('Semantic'),
            __('Unit'),
            __('Default'),
            __('Nullable'),
            __('Displayable'),
            __('Editable'),
            __('Group editable'),
            __('Additional'),
            ],
        'links'=>[]
        ];
        
        $data = $this->getClassProperties(Classes::getNamespaceOfClass($id));        
        $result['data'] = [];
        foreach ($data as $property) {
            $result['data'][] = [
                $property->name,
                $property->description,
                $property->type,
                $property->class,
                $property->semantic,
                $property->unit,
                $property->default,
                $property->nullable,
                $property->displayable,
                $property->editable,
                $property->groupeditable,
                $property->additional
            ];
        }
        
        return $result;
    }
    
    protected function getDataSet($id)
    {
        return [
            'classinfo'=>$this->getClassInfo($id),
            'fieldinfo'=>$this->getFieldInfo($id),
        ];    
    }
    
}