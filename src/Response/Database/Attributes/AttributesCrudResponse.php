<?php

namespace Sunhill\Collection\Response\Database\Attributes;

use Sunhill\Visual\Response\Crud\ListDescriptor;
use Sunhill\Visual\Response\Crud\DialogDescriptor;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Properties\Utils\DefaultNull;
use Sunhill\Visual\Response\Crud\SunhillCrudResponse;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Objects\ORMObject;
use Sunhill\ORM\Facades\Objects;
use Sunhill\ORM\Objects\Tag;
use Illuminate\Support\Facades\DB;
use Sunhill\ORM\Facades\Attributes;

class AttributesCrudResponse extends SunhillCrudResponse
{
    
    protected static $route_base = 'attributes';
    
    protected static $group_action = ['delete','edit'];
    
    protected function getBasicQuery()
    {
        return Attributes::query();
    }
    
    /**
     * Provides additional links (in this case a link for adding tags)
     * @return StdClass[]
     */
    protected function getAdditionalLinks()
    {
        return [
            $this->getStdClass(['target'=>route('attributes.add'),'text'=>__('add'),'class'=>'is-success'])
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
            $this->getStdClass(['value'=>'type','name'=>'type','relations'=>['=','<>']]),
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
        $descriptor->column('type')->title('Type')->setColumnSortable('type');
        $descriptor->column('edit')->link('attributes.edit',['id'=>'id'])->setLinkTitle('edit');
        $descriptor->column('show')->link('attributes.show',['id'=>'id'])->setLinkTitle('show');
        $descriptor->column('delete')->link('attributes.delete',['id'=>'id'])->setLinkTitle('delete');
    }
    
    /**
     * Checks if the given id (in this case classname) exists
     * @param unknown $id
     * @return bool
     */
    protected function IDExists($id): bool
    {
        $query = Attributes::query()->where('id',$id)->first();
        return !empty($query);
    }
    
    protected static $entity = 'attributes';
    
    protected function getAttributeInfo($id)
    {
        $attribute = Attributes::query()->where('id',$id)->first();
        
        return [
            'caption'=>__("Show attribute ':id'", ['id'=>$id]),
            'header'=>[
                __('Key'),
                __('Value')
            ],
            'data'=>[
                [__('id'),$id],
                [__('name'),$attribute->name],
                [__('type'),$attribute->type],
                [__('Allowed classes'),$attribute->allowed_classes],
            ],
            'links'=>[],
        ];
    }
    
    protected function getDataSet($id)
    {
        return [
            'attributeinfo'=>$this->getAttributeInfo($id),
        ];    
    }
    
    protected function defineDialog(DialogDescriptor $descriptor)
    {
        $descriptor->string()->label('Name of the attribute')->name('name')->required()->class('input is-small');
        $descriptor->select()->label('Type of the attribute')->name('type')->entries([
            'Integer'=>'integer',
            'Char'=>'string',
            'Float'=>'float',
            'Text'=>'text'
        ])->class('input is-small');
        $descriptor->list()->label('Allowed classed')->name('allowed_classes')->element('string')->lookup('classes')->groupeditable();        
    }
    
    protected function doExecAdd($parameters)
    {
        if ($attribute = Attributes::query()->where('name',$parameters['name'])->count()) {
            $this->inputError('name','This field is a duplicate.');
            return false;
        }
        Attributes::query()->insert(['name'=>$parameters['name'],'type'=>$parameters['type'],'allowed_classes'=>$parameters['allowed_classes']]);
        return redirect(route('attributes.list', $this->getRoutingParameters(['order'=>'id','page'=>-1])));
    }
    
    protected function getEditValues($id)
    {
        $attribute = Attributes::query()->where('id',$id)->first();
        
        return [
            'name'=>$attribute->name,
            'type'=>$attribute->type,
            'allowed_classes'=>explode('|',substr($attribute->allowed_classes,1,-1)),            
            'name_allowed_classes'=>explode('|',substr($attribute->allowed_classes,1,-1)),
        ];
    }
    
    protected function doExecEdit($id, $parameters)
    {
        if (Attributes::query()->where('name',$parameters['name'])->whereNot('id',$id)->count()) {
            $this->inputError('name','This field is a duplicate.');
            return false;
        }
        Attributes::query()->where('id',$id)->update(['name'=>$parameters['name'],'type'=>$parameters['type'],'allowed_classes'=>$parameters['allowed_classes']]);
        return redirect(route('attributes.list', $this->getRoutingParameters()));
    }
    
    protected function doDelete($id)
    {
        Attributes::query()->where('id',$id)->delete();
        return redirect(route('attributes.list', $this->getRoutingParameters()));
    }
    
    protected function getRecordKeys($ids): array
    {
        $result = Attributes::query()->whereIn('id',$ids)->get();
        $return = [];
        foreach ($result as $entry) {
            $return[$entry->id] = $entry->name;
        }
            
        return $return;
    }
    
    protected function doExecGroupDelete(array $ids)
    {
        Attributes::query()->whereIn('id',$ids)->delete();
        return redirect(route('attributes.list',$this->getRoutingParameters()));
    }
    
    protected function doExecGroupEdit(array $ids, array $parameters)
    {
        Attributes::query()->whereIn('id',$ids)->update($parameters);
        return redirect(route('attributes.list',$this->getRoutingParameters()));
    }
    
    public function remove(array $ids)
    {
        DB::table('attributeobjectassigns')->whereIn('attribute_id',$ids)->delete();
        return redirect(route('attributes.list',$this->getRoutingParameters()));
    }
}