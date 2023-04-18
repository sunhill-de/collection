<?php

namespace Sunhill\Collection\Response\Database\Classes;

use Sunhill\Visual\Response\SunhillListResponse;
use Sunhill\ORM\Facades\Classes;
use Sunhill\Visual\Response\ListDescriptor;

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
        return Classes::getClassCount();        
    }
    
    protected function getData()
    {
        $data = Classes::getAllClasses();
        usort($data, function($a,$b) {
            if ($a[$this->order] == $b[$this->order]) {
                return 0;
            }
            return ($a[$this->order] < $b[$this->order]) ? -1 : 1;
        });
        $data = $this->sliceData($data);
        
        return $data;
    }
    
}  
