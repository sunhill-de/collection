<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\ORM\Facades\Attributes;
use Sunhill\Visual\Response\ListDescriptor;
use Sunhill\Visual\Response\SunhillListResponse;

class ListAttributesResponse extends SunhillListResponse
{

    protected $template = 'collection::attributes.list';
    
    protected $route = 'attributes.list';
    
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->column('id')->title('Id')->searchable();
        $descriptor->column('name')->title('Name')->searchable();
        $descriptor->column('type')->title('Type');
        $descriptor->column('allowed_classes')->title('Allowed classes');
        $descriptor->column('add')->link('attributes.edit',['id'=>'id']);
        $descriptor->column('delete')->link('attributes.delete',['id'=>'id']);
        $descriptor->column('show')->link('attributes.show',['id'=>'id']);
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        return Attributes::getCount();
    }
    
    protected function getData()
    {
        $data = Attributes::getAllAttributes($this->offset*self::ENTRIES_PER_PAGE,self::ENTRIES_PER_PAGE);
/*        usort($data, function($a,$b) {
            if ($a[$this->order] == $b[$this->order]) {
                return 0;
            }
            return ($a[$this->order] < $b[$this->order]) ? -1 : 1;
        }); */
            
       return $data;
    }
        
}
