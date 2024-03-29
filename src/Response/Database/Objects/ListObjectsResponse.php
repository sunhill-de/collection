<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\Visual\Response\Lists\SunhillListResponse;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\Dialogs;
use Sunhill\Collection\Facades\SunhillManager;

class ListObjectsResponse extends SunhillListResponse
{
    
    protected $template = 'collection::objects.list';
    
    protected $route = 'objects.list';
    
    /*
     public function setOffset(int $offset): SunhillListResponse
     {
     $this->setDelta($offset);
     return $this;
     }
     */
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->groupselect();
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
                $object = Objects::load($data_set->$field);
                if ($subfield == 'keyfield') {
                    return SunhillManager::getKeyfield($object);
                } else {
                    return $object->$subfield;
                }
            }
        });
        $descriptor->column('id')->title('ID')->searchable()->setClass('is-narrow');
        $descriptor->column('classname')->title('Class')->searchable()->link('objects.list',['key'=>'classname']);
        $namespace = Classes::getNamespaceOfClass($this->key);
        $columns = $namespace::getInfo('table_columns',['_uuid','keyfield']);
        foreach ($columns as $index => $column) {
            if (is_int($index)) {
                $column_desc = $descriptor->column($column)->title($column);
            } else {
                $column_desc = $descriptor->column($index)->title($index)->buildRule($column);
            }
        }
        $descriptor->column('edit')->link('objects.edit',['id'=>'id'])->setLinkTitle('edit')->setClass('is-narrow');
        $descriptor->column('delete')->link('objects.delete',['id'=>'id'])->setLinkTitle('delete')->setClass('is-narrow');
        $descriptor->column('show')->link('objects.show',['id'=>'id'])->setLinkTitle('show')->setClass('is-narrow');
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        return SunhillManager::getObjectsCount(isset($this->params['key'])?$this->params['key']:'object',[]);
    }
    
    protected function getRouteParameters()
    {
        $result = parent::getRouteParameters();
        $result['key'] = $this->key;
        return $result;
    }
    
    protected function getData()
    {
        if (empty($this->key)) {
            $this->key = 'ORMObject';
        }
        $this->params['namespace'] = Classes::getNamespaceOfClass($this->key);
        $result = SunhillManager::getObjectsList($this->key, [], $this->order, $this->order_dir, $this->offset*self::ENTRIES_PER_PAGE,self::ENTRIES_PER_PAGE);
        $descriptor = new ListDescriptor();
        $this->defineList($descriptor);
        foreach ($descriptor as $column) {
            if (strpos($column->getFieldName(),'->') !== false) {
                [$column_name,$field_name] = explode('->',$column->getFieldName());
                foreach ($result as $entry) {
                    $subobject = Objects::load($entry->$column_name);
                    if ($field_name == 'keyfield') {
                        $this->getKeyfield($subobject);
                    } else {
                        $entry->$column_name = $subobject->$field_name;
                    }
                }
            }
        }
            
        return $result;
    }

    protected function prepareResponse()
    {
        parent::prepareResponse();
        $this->processAdditional();
    }
    
    protected function getFixedInheritance(string $class)
    {
        if ($class == 'object') {
            return ['object'];
        } else {
            return Classes::getInheritanceOfClass($class,true);
        }
    }
    
    protected function processAdditional()
    {
        $this->params['inheritance'] = array_reverse($this->getFixedInheritance($this->params['key']));
    }

}  
