<?php

namespace Sunhill\Collection\Response\Database\Collections;

use Sunhill\Visual\Response\ListDescriptor;
use Sunhill\Visual\Response\SunhillListResponse;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\Dialogs;
use Sunhill\Collection\Facades\SunhillManager;
use Sunhill\ORM\Facades\Collections;

class ListCollectionResponse extends SunhillListResponse
{
    
    protected $template = 'collection::collections.list';
    
    protected $route = 'collections.list';
    
    protected $collection = '';
    
    public function setCollection(string $collection): ListCollectionResponse
    {
        $this->collection = $collection;
        return $this;
    }
    
    /*
     public function setOffset(int $offset): SunhillListResponse
     {
     $this->setDelta($offset);
     return $this;
     }
     */
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->column('name')->title('Name')->searchable();
        $descriptor->column('description')->title('Description');
        $descriptor->column('list')->link('collection.list',['collection'=>'name']);
        $descriptor->column('add')->link('collection.add',['collection'=>'name']);
        $descriptor->column('show')->link('collections.show',['collection'=>'name']);
    }
    
    protected function handleConditions($query, $conditions)
    {
        return $query;    
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        return SunhillManager::getCollectionCount($this->collection, []);
    }
    
    protected function getData()
    {
        return SunhillManager::getCollectionList($this->collection, [], $this->order, $this->order_dir, $this->offset*SELF::ENTRIES_PER_PAGE,self::ENTRIES_PER_PAGE);
    }

}  
