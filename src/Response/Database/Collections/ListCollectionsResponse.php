<?php

namespace Sunhill\Collection\Response\Database\Collections;

use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\Visual\Response\Lists\SunhillListResponse;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Facades\Dialogs;
use Sunhill\Collection\Facades\SunhillManager;

class ListCollectionsResponse extends SunhillListResponse
{
    
    protected $template = 'collection::collections.list';
    
    protected $route = 'collections.list';
    
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
        $descriptor->column('list')->link('collection.list',['collection'=>'name'])->setLinkTitle('list');
        $descriptor->column('add')->link('collection.add',['collection'=>'name'])->setLinkTitle('add');
        $descriptor->column('show')->link('collections.show',['collection'=>'name'])->setLinkTitle('show');
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        return SunhillManager::getCollectionsCount();
    }
    
    protected function getData()
    {
        return SunhillManager::getCollectionsList([],$this->order, $this->order_dir, $this->offset*self::ENTRIES_PER_PAGE, self::ENTRIES_PER_PAGE);
    }

}  
