<?php

namespace Sunhill\Collection\Response\Database\Objects;

use Sunhill\Visual\Response\SunhillListResponse;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Utils\ObjectList;
use Sunhill\Visual\Facades\Dialogs;
use Sunhill\Visual\Facades\SunhillSiteManager;

class ListObjectsResponse extends SunhillListResponse
{

    protected $columns = ['uuid'];
    
    protected $template = 'collection::objects.list';
    
    protected function prepareList($key,$order,$delta,$limit)
    {
        if (empty($key)) {
            $key = 'ORMObject';
        }
        $this->params['namespace'] = Classes::getNamespaceOfClass($key);
        return Objects::getPartialObjectList($key,$order,$delta*$limit,$limit); 
    }
    
    protected function getObjectLink($key, $order = 'id', $delta = 0)
    {
        return route('objects.list',['key'=>$key,'page'=>$delta,'order'=>$order]); 
    }
    
    protected function createEntry($name,$link=null)
    {
        $result = new \StdClass();
        $result->name = $name;
        $result->link = $link;
        return $result;
    }
    
    protected function prepareHeaders(): array
    {
        $result = [
            $this->createEntry(__('id'),$this->getObjectLink($this->params['key'],$this->params['order'],$this->params['delta'])),
            $this->createEntry(__('class'))            
        ];    
        
        $columns = Dialogs::getObjectListFields($this->params['key']);
        foreach ($columns as $index => $column) {
            
            if (is_int($index)) {
                $result[] = $this->createEntry(__($column),$this->getObjectLink($this->params['key'],$column,$this->params['delta']));
            } else {
                $result[] = $this->createEntry(__($index));                
            }
        }
        $result[] = $this->createEntry(" ");
        $result[] = $this->createEntry(" ");
        return $result;
    }
    
    protected function parseColumn($object,$column)
    {
        if (strpos($column,"=>")) {
            list($key,$subkey) = explode("=>",$column);
            $key_object = $object->$key;
            if (is_null($key_object)) {
                return null;            
            } else {
                return $key_object->$subkey;
            }
        } else if ($column == "keyfield") {
            return Dialogs::getObjectKeyfield($object);
        } else {
            return $object->$column;
        }
    }
    
    protected function prepareMatrix($input): array
    {
        $result = [];
        foreach ($input as $object) {
            $row = [];
            $row[] = $this->createEntry($object->getID(),route('objects.show',['id'=>$object->getID()]));
            $row[] = $this->createEntry($object::getInfo('name'),$this->getObjectLink($object::getInfo('name')));            
            $columns = Dialogs::getObjectListFields($this->params['key']);
            foreach ($columns as $index => $column) {
                if (is_int($index)) {
                    $row[] = $this->createEntry($this->parseColumn($object,$column));
                } else {
                    $row[] = $this->createEntry($this->parseColumn($object,$column));                    
                }
            }
            $row[] = $this->createEntry(__("edit"),route('objects.edit',['id'=>$object->getID()]));
            $row[] = $this->createEntry(__("delete"),route('objects.delete',['id'=>$object->getID()]));
            $result[] = $row;
        }
        return $result;
    }
    
    protected function getFixedInheritance(string $class)
    {
        if ($class == 'object') {
            return ['object'];
        } else {
            return Classes::getInheritanceOfClass($class,true);
        }
    }
    
    function getParams(): array
    { 
       return ['key'=>$this->key,'delta'=>$this->delta,'order'=>$this->order];
    }
  
    protected function processAdditional()
    {
        $this->params['inheritance'] = array_reverse($this->getFixedInheritance($this->params['key']));
    }

    protected function getTotalEntryCount()
    {
        $class_namespace = Classes::getNamespaceOfClass(isset($this->params['key'])?$this->params['key']:'object');
        return $class_namespace::search()->count();
    }
    
    
    protected function getPaginatorLink(int $index)
    {
        $class = isset($this->params['key'])?$this->params['key']:'object';
        return route('objects.list',['key'=>$class,'page'=>$index]); 
    }
        
}  
