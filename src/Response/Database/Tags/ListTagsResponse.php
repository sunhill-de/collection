<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\ORM\Facades\Tags;
use Sunhill\Visual\Response\ListDescriptor;
use Sunhill\Visual\Response\SunhillListResponse;

class ListTagsResponse extends SunhillListResponse
{

    protected $template = 'collection::tags.list';
    
    protected $route = 'tags.list';
    
    protected $order = 'name';
    
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->column('id')->title('id')->searchable();
        $descriptor->column('name')->title('Name')->searchable();
        $descriptor->column('parent')->title('Parent');
        $descriptor->column('fullpath')->title('Full path');
        $descriptor->column('edit')->link('tags.add',['id'=>'id']);
        $descriptor->column('show')->link('tags.show',['id'=>'id']);
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        return Tags::getCount();
    }
    
    protected function getData()
    {
        $tags = Tags::getAllTags();
        $result = [];
        foreach ($tags as $tag) {
            $entry = new \StdClass();
            $entry->id = $tag->id;
            $entry->name = $tag->name;
            $entry->fullpath = $tag->fullpath;
            if ($tag->parent_id) {
                $parent = Tags::findTag($tag->parent_id);
                $entry->parent = $parent->name;
            } else {
                $entry->parent = '';
            }
            $entry->parent_id = $tag->parent_id;
            $result[] = $entry;
        }
        usort($result, function($a,$b) {
            $order = $this->order;
            if ($a->$order == $b->$order) {
                return 0;
            }
            return ($a->$order < $b->$order) ? -1 : 1;
        });
        $result = $this->sliceData($result);
       return $result;
    }
    
    
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
        foreach ($input as $tag_desc) {
            $tag = Tags::loadTag($tag_desc->id);
            $row = [];
            $row[] = $this->createEntry($tag->getID(),route('tags.show',['id'=>$tag->getID()]));
            $row[] = $this->createEntry($tag->name);
            if (is_null($tag->parent)) {
                $row[] = $this->createEntry('');
            } else {
                $row[] = $this->createEntry($tag->parent->name);
            }    
            $row[] = $this->createEntry($tag->getFullpath());
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
