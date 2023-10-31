<?php

namespace Sunhill\Collection\Response\Database\Tags;

use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\Visual\Response\Crud\DialogDescriptor;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Properties\Utils\DefaultNull;
use Sunhill\Visual\Response\Crud\SunhillCrudResponse;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Objects\Tag;

class TagsCrudResponse extends SunhillCrudResponse
{
    
    protected static $route_base = 'tags';
    
    protected static $group_action = ['delete','edit'];
    
    /**
     * Provides additional links (in this case a link for adding tags)
     * @return StdClass[]
     */
    protected function getAdditionalLinks()
    {
        return [
            $this->getStdClass(['target'=>route('tags.add'),'text'=>__('add'),'class'=>'is-success'])
        ];
    }
    
    /**
     * This returns the field that can be used in list filters and their allowed relations
     * @return StdClass[]
     */
    protected function getSearchfields()
    {
        return [
            $this->getStdClass(['value'=>'name','name'=>'name','relations'=>['=','<>','<','<=','>','>=','begins with','ends with','contains']]),
            $this->getStdClass(['value'=>'parent','name'=>'parent','relations'=>['=','<>','<','<=','>','>=','begins with','ends with','contains']]),
        ];    
    }

    /**
     * Defines the list for displaying tags
     * {@inheritDoc}
     * @see \Sunhill\Visual\Response\Crud\SunhillSemiCrudResponse::defineList($descriptor)
     */
    protected function defineList(ListDescriptor &$descriptor)
    {
        $descriptor->column('id')->title('id')->setColumnSortable('id');
        $descriptor->column('name')->title('Name')->setColumnSortable('name');
        $descriptor->column('parent')->title('Parent')->setCallback(function($data, $key) {
            if ($data->parent_id) {
                $tag = Tags::loadTag($data->parent_id);
                
                return is_null($tag)?'':$tag->name; // Normally this shouln't be necessary 
            } else {
                return "";
            }
        });
        $descriptor->column('fullpath')->title('Full path');
        $descriptor->column('edit')->link('tags.edit',['id'=>'id'])->setLinkTitle('edit');
        $descriptor->column('show')->link('tags.show',['id'=>'id'])->setLinkTitle('show');
        $descriptor->column('delete')->link('tags.delete',['id'=>'id'])->setLinkTitle('delete');
    }
    
    protected function handleTagsConditions($query, array $conditions)
    {
        foreach ($conditions as $condition) {
            
        }
        return $query;
    }
    
    protected function getTagCount(array $conditions = [])
    {
        $query = Tags::query();
        $query = $this->handleTagsConditions($query, $conditions);
        return $query->count();
    }
    
    protected function getTagList(array $conditions = [], string $order, string $order_dir = 'desc', int $offset = 0, int $limit = 10)
    {
        $query = Tags::query();
        $query = $this->handleTagsConditions($query, $conditions);
        if ($offset) {
            $query->offset($offset);
        }
        if ($limit) {
            $query->limit($limit);
        }
        $query->orderBy($order, $order_dir);
        return $query->get();
    }    
    /**
     * Returns the count of entries for the given filter (if any)
     * @param string $filter
     */
    protected function getEntryCount(): int
    {
        return $this->getTagCount([]);
    }
    
    /**
     * Return the tags that fit to the current filter
     * @return unknown
     */
    protected function getData()
    {
        return $this->getTagList([],$this->order, $this->order_dir, $this->offset*self::ENTRIES_PER_PAGE, self::ENTRIES_PER_PAGE);
    }
    
    /**
     * Checks if the given id (in this case classname) exists
     * @param unknown $id
     * @return bool
     */
    protected function IDExists($id): bool
    {
        return !is_null(Tags::loadTag($id));
    }
    
    protected static $entity = 'tags';
    
    protected function getChildTagCount($fullpath)
    {
        return Tags::query()->where('parent', '=', $fullpath)->count();
    }
    
    protected function getChildTags(int $short)
    {
        return Tags::query()->where('parent', '=', $this->params['fullpath'])->orderBy('id')->limit($short)->get();
    }
    
    protected function getChildObjectCount($fullpath)
    {
        return ORMObject::search()->where('tags','has',$fullpath)->count();
    }
    
    protected function getChildObjects(int $short)
    {
        $return = [];
        $result = ORMObject::search()->where('tags','has',$this->params['fullpath'])->limit($short)->get();
        foreach ($result as $entry) {
            $item = new \StdClass();
            $item->id = $entry->id;
            $object = Objects::load($entry->id);
            $item->class = Objects::getClassnameOf($entry->id);
            $item->class_name = Objects::getClassnameOf($entry->id);
            $item->keyfield = '';
            $return[] = $item;
        }
        return $return;
    }
    
    
    protected function getTagInfo($id)
    {
        $tag = Tags::loadTag($id);
        
        return [
            'caption'=>__("Show tag ':id'", ['id'=>$id]),
            'header'=>[
                __('Key'),
                __('Value')
            ],
            'data'=>[
                [__('id'),$id],
                [__('name'),$tag->name],
                [__('parent'),($tag->parent)?$tag->parent->name:''],
                [__('Full path'),$tag->getFullpath()],
                [__('leafable'),$tag->options & Tag::TO_LEAFABLE],
                [__('child tag count'),$this->getChildTagCount($tag->fullpath)],
                [__('object count'),make_link(route('objects.list',$id),$this->getChildObjectCount($tag->fullpath))],
            ],
            'links'=>[],
        ];
    }
    
    protected function getDataSet($id)
    {
        return [
            'taginfo'=>$this->getTagInfo($id),
        ];    
    }
    
    protected function defineDialog(DialogDescriptor $descriptor)
    {
        $descriptor->string()->label('Name')->name('name')->required();
        $descriptor->checkbox()->label('Leafable')->name('leafable')->groupeditable();
        $descriptor->inputLookup()->label('Parent')->name('parent')->lookup('tags');
    }
    
    protected function doExecAdd($parameters)
    {
        if ($tag = Tags::query()->where('name',$parameters['name'])->where('parent_id',$parameters['parent'])->count()) {
            $this->inputError('name','This field is a duplicate.');
            return false;
        }
        Tags::query()->insert(['name'=>$parameters['name'],'parent_id'=>$parameters['parent']]);
        return redirect(route('tags.list', $this->getRoutingParameters(['order'=>'id','page'=>-1])));
    }
    
    protected function getEditValues($id)
    {
        $tag = Tags::query()->where('id',$id)->first();
        if (!empty($tag->fullpath)) {
            $parts = explode('.',$tag->fullpath);
            array_pop($parts);
            $parent = implode('.',$parts);
        } else {
            $parent = '';
        }
        return [
            'name'=>$tag->name,
            'value_parent'=>$tag->parent_id,
            'input_parent'=>$parent
            
        ];
    }
    
    protected function doExecEdit($id, $parameters)
    {
        if ($tag = Tags::query()->where('name',$parameters['name'])->where('parent_id',$parameters['parent'])->whereNot('id',$id)->count()) {
            $this->inputError('name','This field is a duplicate.');
            return false;
        }
        Tags::query()->where('id',$id)->update(['name'=>$parameters['name'],'parent_id'=>$parameters['parent']]);
        return redirect(route('tags.list', $this->getRoutingParameters()));
    }
    
    protected function doDelete($id)
    {
        Tags::query()->where('id',$id)->delete();
        return redirect(route('tags.list', $this->getRoutingParameters()));
    }
    
    protected function getRecordKeys($ids): array
    {
        $result = Tags::query()->whereIn('id',$ids)->get();
        $return = [];
        foreach ($result as $entry) {
            $return[$entry->id] = $entry->fullpath;
        }
            
        return $return;
    }
    
    protected function doExecGroupDelete(array $ids)
    {
        Tags::query()->whereIn('id',$ids)->delete();
        return redirect(route('tags.list',$this->getRoutingParameters()));
    }
    
    protected function doExecGroupEdit(array $ids, array $parameters)
    {
        Tags::query()->whereIn('id',$ids)->update($parameters);
        return redirect(route('tags.list',$this->getRoutingParameters()));
    }
}