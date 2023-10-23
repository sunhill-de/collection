<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\ORM\Facades\Tags;
use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\Visual\Response\Lists\SunhillListResponse;
use Sunhill\Collection\Utils\HasID;

class ListChildrenResponse extends SunhillListResponse
{

    use HasID;
    
    protected $template = 'collection::tags.list';
        
    protected $route = 'tags.listchildren';
    
    protected $order = 'name';
    
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->column('id')->title('id')->searchable();
        $descriptor->column('name')->title('Name')->searchable();
        $descriptor->column('parent')->title('Parent')->setCallback(function($data, $key) {
            if ($data->parent_id) {
                $tag = Tags::loadTag($data->parent_id);
                return $tag->name;
            } else {
                return "";
            }
        });
            $descriptor->column('fullpath')->title('Full path');
            $descriptor->column('edit')->link('tags.edit',['id'=>'id'])->setLinkTitle('edit');
            $descriptor->column('show')->link('tags.show',['id'=>'id'])->setLinkTitle('show');
            $descriptor->column('delete')->link('tags.delete',['id'=>'id'])->setLinkTitle('delete');
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        return Tags::query()->where('parent_id', '=', $this->id)->count();
    }
    
    protected function getData()
    {
        return Tags::query()->where('parent_id', '=', $this->id)->offset($this->offset*self::ENTRIES_PER_PAGE)->limit(self::ENTRIES_PER_PAGE)->get();
    }
    
  
}
