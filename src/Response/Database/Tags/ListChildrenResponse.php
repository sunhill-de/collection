<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\ORM\Facades\Tags;
use Sunhill\Visual\Response\Lists\ListDescriptor;
use Sunhill\Visual\Response\SunhillListResponse;

class ListChildrenResponse extends SunhillListResponse
{

    protected $template = 'collection::tags.list';
        
    protected $route = 'tags.listchildren';
    
    protected $order = 'name';
    
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->column('class')->title('Class name')->searchable();
        $descriptor->column('name')->title('Name')->searchable();
        $descriptor->column('description')->title('Description');
        $descriptor->column('parent')->title('Parent');
        $descriptor->column('list')->link('objects.list',['key'=>'name']);
        $descriptor->column('add')->link('objects.add',['class'=>'name']);
        $descriptor->column('show')->link('classes.show',['class'=>'name']);
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
    }
    
    protected function getData()
    {
    }
    
  
}
