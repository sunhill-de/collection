<?php

namespace Sunhill\Collection\Response\Database\Collections;

use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Properties\Utils\DefaultNull;
use Sunhill\Visual\Response\Crud\SunhillSemiCrudResponse;
use Sunhill\ORM\Facades\Collections;

class CollectionsCrudResponse extends SunhillSemiCrudResponse
{
    
    protected static $route_base = 'collections';
        
    protected function getDefaultOrder(): string
    {
        return 'name';
    }
    
    /**
     * Provides additional links (in this case a link for adding tags)
     * @return StdClass[]
     */
    protected function getAdditionalLinks()
    {
        return [
        ];
    }
    
    /**
     * This returns the field that can be used in list filters and their allowed relations
     * @return StdClass[]
     */
    protected function getSearchfields()
    {
        return [
        ];
    }
    
    /**
     * Defines the list for displaying tags
     * {@inheritDoc}
     * @see \Sunhill\Visual\Response\Crud\SunhillSemiCrudResponse::defineList($descriptor)
     */
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->column('name')->title('Name')->searchable('name');
        $descriptor->column('description')->title('Description');
        $descriptor->column('list')->link('collection.list',['collection'=>'name'])->setLinkTitle('list');
        $descriptor->column('add')->link('collection.add',['collection'=>'name'])->setLinkTitle('add');
        $descriptor->column('show')->link('collections.show',['id'=>'name'])->setLinkTitle('show');
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        return count(Collections::getRegisteredCollections());
    }
    
    /**
     * Return the tags that fit to the current filter
     * @return unknown
     */
    protected function getData()
    {
        return Collections::getRegisteredCollections();
    }
    
    /**
     * Checks if the given id (in this case classname) exists
     * @param unknown $id
     * @return bool
     */
    protected function IDExists($id): bool
    {
    }
    
    protected static $entity = 'collection';
    
    protected function getDataSet($id)
    {
        return [
        ];
    }
    
}