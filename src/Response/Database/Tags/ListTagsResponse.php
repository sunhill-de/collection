<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\ORM\Facades\Tags;
use Sunhill\Visual\Response\SunhillListResponse;

class ListTagsResponse extends SunhillListResponse
{

    protected $columns = ['name','parent'];
    
    protected $template = 'collection::tags.list';
    
    protected function prepareList($key,$order,$delta,$limit)
    {
        $tags = Tags::getAllTags($delta*$limit,$limit); 
        return $tags;
    }
    
    protected function getTotalEntryCount()
    {
        return Tags::getCount();
    }
    
    protected function getTagLink($key, $order = 'id', $delta = 0)
    {
        return route('tags.list',['key'=>$key,'order'=>$order,'delta'=>$delta]); 
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
            $this->createEntry(__('id'),  $this->getTagLink($this->params['key'],$this->params['order'],$this->params['delta'])),
            $this->createEntry(__('name'),$this->getTagLink($this->params['key'],'name',$this->params['delta'])),
            $this->createEntry(__('parent'),$this->getTagLink($this->params['key'],'parent',$this->params['delta'])),
            $this->createEntry(__('fullpath'),$this->getTagLink($this->params['key'],'full_path',$this->params['delta'])),
            $result[] = $this->createEntry(" "),
            $result[] = $this->createEntry(" ")
        ];    
        return $result;
    }
    
    protected function prepareMatrix($input): array
    {
        $result = [];
        foreach ($input as $tag) {
            $row = [];
            $row[] = $this->createEntry($tag->id,route('tags.show',['id'=>$tag->id]));
            $row[] = $this->createEntry($tag->name);
            $parent = $tag->parent_id;
            if (is_null($parent)) {
                $row[] = $this->createEntry('&nsbp;');
            } else {
                $row[] = $this->createEntry('');
            }    
            $row[] = $this->createEntry('');
            $row[] = $this->createEntry(__("edit"),route('tags.edit',['id'=>$tag->id]));
            $row[] = $this->createEntry(__("delete"),route('tags.delete',['id'=>$tag->id]));
            $result[] = $row;
        }
        return $result;
    }
    
    function getParams(): array
    { 
        return ['key'=>$this->key,'delta'=>$this->delta,'order'=>$this->order];
    }
  
}
