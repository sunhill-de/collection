<?php

namespace Sunhill\Collection\Response\Database\Common;

use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Properties\Utils\DefaultNull;
use Sunhill\Visual\Response\Crud\SunhillCrudResponse;
use Sunhill\Visual\Response\Crud\DialogDescriptor;
use Sunhill\ORM\Facades\Collections;
use Sunhill\ORM\Facades\Objects;
use Sunhill\Collection\Facades\SunhillManager;
use Sunhill\ORM\Properties\PropertyVarchar;
use Sunhill\ORM\Properties\PropertyBoolean;
use Sunhill\ORM\Properties\PropertyCalculated;
use Sunhill\ORM\Properties\PropertyEnum;
use Sunhill\ORM\Properties\PropertyInteger;
use Sunhill\ORM\Properties\PropertyDate;
use Sunhill\ORM\Properties\PropertyTime;
use Sunhill\ORM\Properties\PropertyDatetime;
use Sunhill\ORM\Properties\PropertyFloat;
use Sunhill\ORM\Properties\PropertyText;
use Sunhill\ORM\Properties\PropertyArray;
use Sunhill\ORM\Properties\PropertyMap;
use Sunhill\ORM\Properties\PropertyObject;
use Sunhill\ORM\Properties\PropertyCollection;
use Sunhill\ORM\Objects\PropertiesCollection;

abstract class PropertiesCollectionCrudResponse extends SunhillCrudResponse
{
        
    protected static $group_action = ['delete','edit'];
    
    protected $collection = '';
    
    abstract protected function getNamespace(): string;

    public function setClass(string $class)
    {
        $this->collection = $class;    
    }
    
    /**
     * Provides additional links (in this case a link for adding tags)
     * @return StdClass[]
     */
    protected function getAdditionalLinks()
    {
        return [
            $this->getStdClass(['target'=>route(static::$route_base.'.add', ['class'=>$this->collection]),'text'=>__('add'),'class'=>'is-success'])
        ];
    }
    
    protected function getRoutingParameters($params = null)
    {
        if (!is_null($params)) {
            return parent::getRoutingParameters($params);
        }
        return ['class'=>$this->collection];
    }
    
    protected function getBasicQuery()
    {
        $namespace = $this->getNamespace();
        return $namespace::query();
    }
    
    private function getTableColumns()
    {
        return $this->getNamespace()::getInfo('table_columns');
    }
    
    private function getTableColumnProperties(string $column)
    {
        $class = $this->getNamespace();
        return $class::getPropertyObject($column);
    }
    
    /**
     * This returns the field that can be used in list filters and their allowed relations
     * @return StdClass[]
     */
    protected function getSearchfields()
    {
        $result = [];
        
        return $result;
    }
    
    /**
     * Defines the list for displaying tags
     * {@inheritDoc}
     * @see \Sunhill\Visual\Response\Crud\SunhillSemiCrudResponse::defineList($descriptor)
     */
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->column('id')->title('ID')->searchable('id')->setColumnSortable('id');
        $descriptor->setDataCallback(function($entry, $data_set) {
            $rule = empty($entry->getBuildRule())?$entry->getFieldName():$entry->getBuildRule();
            if (property_exists($data_set, $rule)) {
                return $data_set->$rule;
            }
            if (strpos($rule,'->') !== false) {
                [$field,$subfield] = explode('->',$rule);
                if (is_null($data_set->$field)) {
                    return '';
                }
                $property = $this->getNamespace()::getPropertyObject($field);
                if (is_a($property,PropertyCollection::class)) {
                    $collection = $property->getAllowedCollection();
                    $object = Collections::loadCollection($collection, $data_set->$field);
                } else if (is_a($property, PropertyObject::class)) {
                    $object = Objects::load($data_set->$field);                    
                }
                if ($subfield == 'keyfield') {
                    return SunhillManager::getKeyfield($object);
                } else {
                    return $object->$subfield;
                }
            }
        });
            $columns = $this->getTableColumns();

        foreach ($columns as $index => $column) {
            if (is_int($index)) {
                $property = $this->getTableColumnProperties($column);
                $column_desc = $descriptor->column($column)->title($column);
                if ($property->get_sortable()) {
                    $column_desc->setColumnSortable($column);
                }
            } else {
                $property = $this->getTableColumnProperties($index);
                $column_desc = $descriptor->column($index)->title($index)->buildRule($column);
                if ($property->get_sortable()) {
                    $column_desc->setColumnSortable($index);
                }
            }
        }
        $descriptor->column('edit')->link(static::$route_base.'.edit',['class'=>'class','id'=>'id'])->setLinkTitle('edit');
        $descriptor->column('delete')->link(static::$route_base.'.delete',['class'=>'class','id'=>'id'])->setLinkTitle('delete');
        $descriptor->column('show')->link(static::$route_base.'.show',['class'=>'class','id'=>'id'])->setLinkTitle('show');
    }
    
    
    /**
     * Checks if the given id (in this case classname) exists
     * @param unknown $id
     * @return bool
     */
    protected function IDExists($id): bool
    {
        $entry = $this->getNamespace()::query()->where('id',$id)->first();
        return (!empty($entry));
    }
    
    abstract protected function getPropertiesHavingObject(int $id);
    
    protected function getTitle(string $prefix, $additional = null): string
    {
        if ($additional) {
            return __(':prefix :entity ":additional" of type ":type"',['prefix'=>$prefix,'entity'=>static::$entity,'additional'=>$additional,'type'=>$this->collection]);
        } else {
            return __(':prefix :entity of type ":type"',['prefix'=>$prefix,'entity'=>static::$entity,'type'=>$this->collection]);
        }
    }
      
    protected function getPropertiesCollectionProperties(int $id): array
    {
        $object = $this->getPropertiesHavingObject($id);
        $properties = $object->getProperties();
        $result = [];
        
        foreach ($properties as $property) {
            $name = $property->name;
            switch ($property::class) {
                case PropertyArray::class:
                    $subresult = [];
                    foreach ($object->$name as $value) {
                        if (is_scalar($value)) {
                            $subresult[] = $value;
                        } else if (is_a($value, PropertiesCollection::class)) {
                            $subresult[] = SunhillManager::getKeyfield($value);
                        }
                    }
                    $result[] = [__($name), $subresult];
                    break;
                case PropertyObject::class:
                case PropertyCollection::class:
                    $value = $object->$name;
                    if ($value) {
                        $result[] = [__($name), SunhillManager::getKeyfield($object->$name)];
                    }
                    break;
                default:
                    $result[] = [__($name), $object->$name];
            }
        }
        
        return $result;
    }
    
    protected function getObjectData(int $id): array
    {
        return [
            'caption'=>__($this->getTitle('Show',$id)),
            'header'=>[
                __('Key'),
                __('Value')
            ],
            'data'=>$this->getPropertiesCollectionProperties($id),
            'links'=>[],
        ];
        
    }
    
    protected function getDataSet($id)
    {
        return [
            'object'=>$this->getObjectData($id)            
        ];
    }
    
    protected function getArray(DialogDescriptor $descriptor, $property)
    {
        $field = $descriptor->list();
        switch ($property->getElementType()) {
            case PropertyObject::class:
                $field->element('string')->lookup(static::$entity.'field')->lookup_additional($this->collection,$property->name);
                break;
            case PropertyCollection::class:
                $field->element('string')->lookup(static::$entity.'field')->lookup_additional($this->collection,$property->name);
                break;
            default:    
                $field->element('string');
                break;
        }
        return $field;        
    }
    
    protected function getMap(DialogDescriptor $descriptor, $property)
    {
        $field = $descriptor->list();
        
        return $field;
    }
    
    protected function getObject(DialogDescriptor $descriptor, $property)
    {
        $field = $descriptor->inputLookup();
        $field->lookup(static::$entity.'field')->lookup_additional($this->collection, $property->getName());
        
        return $field;
    }
    
    protected function getCollection(DialogDescriptor $descriptor, $property)
    {
        $field = $descriptor->inputLookup();
        $field->lookup(static::$entity.'field')->lookup_additional($this->collection,$property->getName());

        return $field;        
    }
    
    protected function defineDialog(DialogDescriptor $descriptor)
    {
        $properties = $this->getNamespace()::getAllPropertyDefinitions();
        foreach ($properties as $name => $property) {
            if ($property->name[0] == '_') {
                continue;
            }
            switch ($property::class) {
                case PropertyVarchar::class:
                    $field = $descriptor->string();
                    break;
                case PropertyInteger::class:
                case PropertyFloat::class:
                    $field = $descriptor->number();
                    break;
                case PropertyText::class:
                    $field = $descriptor->text();
                    break;
                case PropertyDate::class:
                    $field = $descriptor->date();
                    break;
                case PropertyTime::class:
                    $field = $descriptor->time();
                    break;
                case PropertyDatetime::class:
                    $field = $descriptor->datetime();
                    break;
                case PropertyBoolean::class:
                    $field = $descriptor->checkbox();
                    break;
                case PropertyEnum::class:
                    $field = $descriptor->select();  
                    $entries = $property->getEnumValues();
                    $result = [];
                    foreach ($entries as $entry) {
                        $result[$entry] = $entry;
                    }
                    $field->entries($result);
                    break;
                case PropertyArray::class:
                    $field = $this->getArray($descriptor,$property);
                    break;
                case PropertyMap::class:
                    $field = $this->getMap($descriptor,$property);
                    break;
                case PropertyObject::class:
                    $field = $this->getObject($descriptor,$property);
                    break;
                case PropertyCollection::class:
                    $field = $this->getCollection($descriptor,$property);
                    break;
                default:
                    continue 2;
            }
            $field->label($name)->name($name);
        }
    }
    
    protected function doExecAdd($parameters)
    {
        $namespace = $this->getNamespace();
        $object = new $namespace();
        foreach ($namespace::getAllPropertyDefinitions() as $name => $property) {
            if ($name[0] == '_') {
                continue; // Skip hidden fields
            }
            if ($name == 'tags') {
                continue;
            }
            $object->$name = $parameters[$name];
        }
        $object->commit();
        return redirect(route(static::$route_base.'.list', $this->getRoutingParameters(['class'=>$this->collection,'order'=>'id','page'=>-1])));
    }
    
    protected function getEditValues($id)
    {
        $object = $this->getPropertiesHavingObject($id);
        
    }
    
    protected function doExecEdit($id, $parameters)
    {
    }
    
    protected function doDelete($id)
    {
    }
    
    protected function getRecordKeys($ids): array
    {
    }
    
    protected function doExecGroupDelete(array $ids)
    {
    }
    
    protected function doExecGroupEdit(array $ids, array $parameters)
    {
    }
    
}