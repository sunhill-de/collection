<?php

namespace Sunhill\Collection\Response\Database\Classes;

use Sunhill\Visual\Response\SunhillListResponse;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Response\ListDescriptor;
use Sunhill\Collection\Facades\SunhillManager;

class ListClassesResponse extends SunhillListResponse
{
    
    protected $template = 'collection::classes.list';
  
    protected $route = 'classes.list';
    
    protected $order = 'name';
    
    protected function defineList(ListDescriptor &$descriptor)
    {
         $descriptor->column('class')->title('Class name')->searchable();
         $descriptor->column('name')->title('Name')->searchable();
         $descriptor->column('description')->title('Description');
         $descriptor->column('parent')->title('Parent');
         $descriptor->column('list')->link('objects.list',['key'=>'name'])->setLinkTitle('list');
         $descriptor->column('add')->link('objects.add',['class'=>'name'])->setLinkTitle('add');
         $descriptor->column('show')->link('classes.show',['class'=>'name'])->setLinkTitle('show');
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        return SunhillManager::getClassCount([]);
    }
    
    protected function getData()
    {
        return SunhillManager::getClassList([],$this->order, $this->order_dir, $this->offset*self::ENTRIES_PER_PAGE, self::ENTRIES_PER_PAGE);
    }
    
}  
