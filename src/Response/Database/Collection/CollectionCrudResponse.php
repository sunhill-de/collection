<?php

namespace Sunhill\Collection\Response\Database\Collection;

use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Properties\Utils\DefaultNull;
use Sunhill\Visual\Response\Crud\SunhillCrudResponse;
use Sunhill\Visual\Response\Crud\DialogDescriptor;

class CollectionCrudResponse extends SunhillCrudResponse
{
    
    protected static $route_base = 'collection';
    
    protected static $group_action = ['delete','edit'];
    
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
    }
    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
    }
    
    /**
     * Return the tags that fit to the current filter
     * @return unknown
     */
    protected function getData()
    {
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
    
    protected function defineDialog(DialogDescriptor $descriptor)
    {
    }
    
    protected function doExecAdd($parameters)
    {
    }
    
    protected function getEditValues($id)
    {
    }
    
    protected function doExecEdit($id, $parameters)
    {
    }
    
    protected function doDelete($id)
    {
    }
    
    protected function getRecordKeys($ids): array
    {
    }
    
    protected function doExecGroupDelete(array $ids)
    {
    }
    
    protected function doExecGroupEdit(array $ids, array $parameters)
    {
    }
    
}