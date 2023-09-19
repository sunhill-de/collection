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
        $descriptor->column('id')->title('id')->searchable();
        $descriptor->column('class')->title('class')->link('objects.list',['key'=>'class'])->searchable()->displayCallback(function($data) {
            return $data::getInfo('name'); 
        });;
        
        $columns = Dialogs::getObjectListFields($this->key);
        foreach ($columns as $index => $column) {
            $column_obj = $descriptor->column($column);
            if (is_int($index)) {
                $column_obj = $column_obj->title($column);
            } else {
                $column_obj = $column_obj->title($index);
            }
        }
        
        $descriptor->column('edit')->link('objects.edit',['id'=>'id']);
        $descriptor->column('delete')->link('objects.add',['id'=>'id']);
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
