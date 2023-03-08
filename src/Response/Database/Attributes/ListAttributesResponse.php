<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\ORM\Facades\Attributes;
use Sunhill\Visual\Response\SunhillListResponse;

class ListAttributesResponse extends SunhillListResponse
{

    protected $columns = ['name','parent'];
    
    protected $template = 'collection::attributes.list';
    
    protected function prepareList($key,$order,$delta,$limit)
    {
        $attributes = Attributes::getAllAttributes($delta*$limit,$limit); 
        return $attributes;
    }
    
    protected function getTotalEntryCount()
    {
        return Attributes::getCount();
    }
    
    protected function getAttributeLink($key, $order = 'id', $delta = 0)
    {
        return route('attributes.list',['key'=>$key,'order'=>$order,'delta'=>$delta]); 
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
            $this->createEntry(__('Id'),  $this->getAttributeLink($this->params['key'],$this->params['order'],$this->params['delta'])),
            $this->createEntry(__('Name'),$this->getAttributeLink($this->params['key'],'name',$this->params['delta'])),
            $this->createEntry(__('Type'),$this->getAttributeLink($this->params['key'],'parent',$this->params['delta'])),
            $this->createEntry(__('Allowed classes'),$this->getAttributeLink($this->params['key'],'full_path',$this->params['delta'])),
            $result[] = $this->createEntry(" "),
            $result[] = $this->createEntry(" ")
        ];    
        return $result;
    }
    
    protected function prepareMatrix($input): array
    {
        $result = [];
        foreach ($input as $attribute) {
            $row = [];
            $row[] = $this->createEntry($attribute->id,route('attributes.show',['id'=>$attribute->id]));
            $row[] = $this->createEntry($attribute->name);
            $row[] = $this->createEntry($attribute->type);
            $row[] = $this->createEntry($attribute->allowedobjects);
            $row[] = $this->createEntry(__("edit"),route('attributes.edit',['id'=>$attribute->id]));
            $row[] = $this->createEntry(__("delete"),route('attributes.delete',['id'=>$attribute->id]));
            $result[] = $row;
        }
        return $result;
    }
    
    function getParams(): array
    { 
        return ['key'=>$this->key,'delta'=>$this->delta,'order'=>$this->order];
    }
  
}
