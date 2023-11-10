<?php

namespace Sunhill\Collection\Response\Database\Common;

use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Properties\Utils\DefaultNull;
use Sunhill\Visual\Response\Crud\SunhillCrudResponse;
use Sunhill\Visual\Response\Crud\DialogDescriptor;
use Sunhill\ORM\Facades\Collections;

abstract class PropertiesCollectionCrudResponse extends SunhillCrudResponse
{
        
    protected static $group_action = ['delete','edit'];
    
    protected $collection = '';
    
    abstract protected function getNamespace(): string;

    public function setClass(string $class)
    {
        $this->collection = $class;    
    }
    
    /**
     * Provides additional links (in this case a link for adding tags)
     * @return StdClass[]
     */
    protected function getAdditionalLinks()
    {
        return [
            $this->getStdClass(['target'=>route(static::$route_base.'.add', ['class'=>$this->collection]),'text'=>__('add'),'class'=>'is-success'])
        ];
    }
    
    protected function getRoutingParameters($params = null)
    {
        if (!is_null($params)) {
            return parent::getRoutingParameters($params);
        }
        return ['class'=>$this->collection];
    }
    
    protected function getBasicQuery()
    {
        $namespace = $this->getNamespace();
        return $namespace::query();
    }
    
    private function getTableColumns()
    {
        return $this->getNamespace()::getInfo('table_columns');
    }
    
    private function getTableColumnProperties(string $column)
    {
        $class = $this->getNamespace();
        return $class::getPropertyObject($column);
    }
    
    /**
     * This returns the field that can be used in list filters and their allowed relations
     * @return StdClass[]
     */
    protected function getSearchfields()
    {
        $result = [];
        
        return $result;
    }
    
    /**
     * Defines the list for displaying tags
     * {@inheritDoc}
     * @see \Sunhill\Visual\Response\Crud\SunhillSemiCrudResponse::defineList($descriptor)
     */
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->column('id')->title('ID')->searchable('id')->setColumnSortable('id');
        $columns = $this->getTableColumns();

        foreach ($columns as $index => $column) {
            if (is_int($index)) {
                $property = $this->getTableColumnProperties($column);
                $column_desc = $descriptor->column($column)->title($column);
                if ($property->get_sortable()) {
                    $column_desc->setColumnSortable($column);
                }
            } else {
                $property = $this->getTableColumnProperties($index);
                $column_desc = $descriptor->column($index)->title($index);
                if ($property->get_sortable()) {
                    $column_desc->setColumnSortable($index);
                }
            }
        }
        $descriptor->column('edit')->link(static::$route_base.'.edit',['class'=>'class','id'=>'id'])->setLinkTitle('edit');
        $descriptor->column('delete')->link(static::$route_base.'.delete',['class'=>'class','id'=>'id'])->setLinkTitle('delete');
        $descriptor->column('show')->link(static::$route_base.'.show',['class'=>'class','id'=>'id'])->setLinkTitle('show');
    }
    
    
    /**
     * Checks if the given id (in this case classname) exists
     * @param unknown $id
     * @return bool
     */
    protected function IDExists($id): bool
    {
        $entry = $this->getNamespace()::query()->where('id',$id)->first();
        return (!empty($entry));
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