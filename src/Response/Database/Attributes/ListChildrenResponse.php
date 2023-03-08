<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\ORM\Facades\Attributes;
use Sunhill\Visual\Response\SunhillListResponse;

class ListChildrenResponse extends SunhillListResponse
{

    protected $columns = ['name','parent'];
    
    protected $template = 'collection::Attributes.list';
    
    protected function prepareList($key,$order,$delta,$limit)
    {
        $Attributes = Attributes::getAllAttributes($delta*$limit,$limit); 
        return $Attributes;
    }
    
    protected function getTotalEntryCount()
    {
        return Attributes::getCount();
    }
    
    protected function getAttributeLink($key, $order = 'id', $delta = 0)
    {
        return route('Attributes.list',['key'=>$key,'order'=>$order,'delta'=>$delta]); 
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
            $this->createEntry(__('id'),  $this->getAttributeLink($this->params['key'],$this->params['order'],$this->params['delta'])),
            $this->createEntry(__('name'),$this->getAttributeLink($this->params['key'],'name',$this->params['delta'])),
            $this->createEntry(__('parent'),$this->getAttributeLink($this->params['key'],'parent',$this->params['delta'])),
            $this->createEntry(__('fullpath'),$this->getAttributeLink($this->params['key'],'full_path',$this->params['delta'])),
            $result[] = $this->createEntry(" "),
            $result[] = $this->createEntry(" ")
        ];    
        return $result;
    }
    
    protected function prepareMatrix($input): array
    {
        $result = [];
        foreach ($input as $Attribute_desc) {
            $Attribute = Attributes::loadAttribute($Attribute_desc->id);
            $row = [];
            $row[] = $this->createEntry($Attribute->getID(),route('Attributes.show',['id'=>$Attribute->getID()]));
            $row[] = $this->createEntry($Attribute->name);
            if (is_null($Attribute->parent)) {
                $row[] = $this->createEntry('');
            } else {
                $row[] = $this->createEntry($Attribute->parent->name);
            }    
            $row[] = $this->createEntry($Attribute->getFullpath());
            $row[] = $this->createEntry(__("edit"),route('Attributes.edit',['id'=>$Attribute->id]));
            $row[] = $this->createEntry(__("delete"),route('Attributes.delete',['id'=>$Attribute->id]));
            $result[] = $row;
        }
        return $result;
    }
    
    function getParams(): array
    { 
        return ['key'=>$this->key,'delta'=>$this->delta,'order'=>$this->order];
    }
  
}
