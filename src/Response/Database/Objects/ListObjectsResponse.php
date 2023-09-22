<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Sunhill\Visual\Response\ListDescriptor;
use Sunhill\Visual\Response\SunhillListResponse;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\Dialogs;

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
        $descriptor->column('id')->title('ID')->searchable()->setClass('is-narrow');
        $descriptor->column('classname')->title('Class')->searchable();
        $namespace = Classes::getNamespaceOfClass($this->key);
        $columns = $namespace::getInfo('table_columns',['_uuid']);
        foreach ($columns as $index => $column) {
            if (is_int($index)) {
                $column_desc = $descriptor->column($column)->title($column);
            } else {
                $column_desc = $descriptor->column($index)->title($index);
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
        $class_namespace = Classes::getNamespaceOfClass(isset($this->params['key'])?$this->params['key']:'object');
        return $class_namespace::search()->count();
    }
    
    protected function getData()
    {
        if (empty($this->key)) {
            $this->key = 'ORMObject';
        }
        $this->params['namespace'] = Classes::getNamespaceOfClass($this->key);
        return Objects::getPartialObjectList($this->key,$this->order,$this->offset*self::ENTRIES_PER_PAGE,self::ENTRIES_PER_PAGE);
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
