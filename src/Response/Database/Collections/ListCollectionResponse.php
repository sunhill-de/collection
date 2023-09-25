<?php

namespace Sunhill\Collection\Response\Database\Collections;

use Sunhill\Visual\Response\Lists\ListDescriptor;
use Sunhill\Visual\Response\Lists\SunhillListResponse;
use Sunhill\Collection\Facades\SunhillManager;
use Sunhill\ORM\Facades\Collections;

/**
 * In constract to the response in plural (ListCollectionsResponse) this response lists the objects of @author klaus
 * certain collection.
 * @author klaus
 *
 */
class ListCollectionResponse extends SunhillListResponse
{
    
    protected $template = 'collection::collection.list';
    
    protected $route = 'collection.list';
    
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
        $descriptor->column('id')->title('ID')->searchable();
        $namespace = Collections::searchCollection($this->collection);
        $columns = $namespace::getInfo('table_columns',[]);
        foreach ($columns as $index => $column) {
            if (is_int($index)) {
                $column_desc = $descriptor->column($column)->title($column);
            } else {
                $column_desc = $descriptor->column($index)->title($index);
            }
        }
        $descriptor->column('edit')->link('collection.edit',['collection'=>'class','id'=>'id'])->setLinkTitle('edit');
        $descriptor->column('delete')->link('collection.delete',['collection'=>'class','id'=>'id'])->setLinkTitle('delete');
        $descriptor->column('show')->link('collection.show',['collection'=>'class','id'=>'id'])->setLinkTitle('show');         
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
    
    protected function getRouteParameters()
    {
        $result = parent::getRouteParameters();
        $result['collection'] = $this->collection;
        return $result;
    }
    
    protected function getData()
    {
        return SunhillManager::getCollectionList($this->collection, [], $this->order, $this->order_dir, $this->offset*SELF::ENTRIES_PER_PAGE,self::ENTRIES_PER_PAGE);
    }

    public function prepareResponse()
    {
        parent::prepareResponse();
        $infos = SunhillManager::getCollectionListParameters($this->collection);
        $this->params = array_merge($this->params, $infos);
    }
    
}  
