<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\ORM\Facades\Attributes;
use Sunhill\Visual\Response\ListDescriptor;
use Sunhill\Visual\Response\SunhillListResponse;
use Sunhill\Collection\Facades\SunhillManager;

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
        $descriptor->column('edit')->link('attributes.edit',['id'=>'id'])->setLinkTitle('edit');
        $descriptor->column('delete')->link('attributes.delete',['id'=>'id'])->setLinkTitle('delete');
        $descriptor->column('show')->link('attributes.show',['id'=>'id'])->setLinkTitle('show');
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        return SunhillManager::getAttributesCount();
    }
    
    protected function getData()
    {
        return SunhillManager::getAttributesList([],$this->order, $this->order_dir, $this->offset*self::ENTRIES_PER_PAGE, self::ENTRIES_PER_PAGE);
    }
        
}
