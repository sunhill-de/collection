<?php
/**
 * @file SunhillManager_utils.php
 * A trait for better overview that deals with handling of collections
 * Lang en
 * Reviewstatus: 2023-09-13
 * Localization: complete
 * Documentation: unknown
 * Tests: unknown
 * Coverage: unknown
 * Dependencies:
 */

namespace Sunhill\Collection\Managers\Components;

use Sunhill\ORM\Objects\PropertiesCollection;

trait SunhillManager_utils
{

    protected function getTableColumn(PropertiesCollection $collection, string $column)
    {
        if (strpos($column,'->') === false) {
            switch ($column) {
                case 'keyfield':
                    $result = $this->getKeyfield($collection);
                    break;
                case 'classname':
                    $result = $collection::getInfo('name','');
                    break;
                default:    
                    $result = $collection->$column;
                    break;
            }
            return empty($result)?'':$result;
        } else {
            list($field,$subfield) = explode('->',$column);
            $field = $collection->$field;
            if (empty($field)) {
                return '';
            }
            if ($subfield == 'keyfield') {
                return $this->getKeyfield($field);
            }
            return $field->$subfield;
        }
    }
    
    /**
     * Replaces all occurances of :XXXX with $collection->XXXX
     * @param PropertiesCollection $collection
     * @param string $input
     * @return string
     */
    protected function replaceVariables(PropertiesCollection $collection, string $input): string
    {
        preg_match_all('/\:([A-Za-z_0-9\->]+)/s',$input,$matches);
        foreach ($matches[1] as $match) {
            $input = str_replace(':'.$match,$this->getTableColumn($collection,$match),$input);
        }
        return $input;
    }
    
    protected function replaceConditionalFields(PropertiesCollection $collection, string $input): string
    {
        preg_match_all('/(\S+)\?(\S+)/s', $input, $matches);
        for ($i=0;$i<count($matches[0]);$i++) {
            $result = $this->getTableColumn($collection, $matches[1][$i]);
            if (empty($result)) {
                $input = str_replace($matches[0][$i],'', $input);
            } else {
                $input = str_replace($matches[0][$i],
                    $this->replaceVariables($collection, $matches[2][$i]),
                    $input);
            }
        }
        return $input;
    }
  
    protected function getTableRow(PropertiesCollection $collection)
    {
        $result = [
            'id'=>$collection->getID(),
            'class'=>$collection::getInfo('name')
        ];
        
        foreach ($collection::getInfo('table_columns',['uuid'=>'_uuid']) as $name => $column) {
            if (is_numeric($name)) {
                $result[$column] = $this->getTableColumn($collection, $column);
            } else {
                $result[$name] = $this->getTableColumn($collection, $column);
            }
        }
        
        return $result;
    }
    
    protected function buildCollectionQuery(string $collection_namespace, array $conditions = [], string $order = 'id', string $order_direction = 'asc')
    {
        $query = $collection_namespace::search();
        foreach ($conditions as $condition) {
            $query->where($condition['key'],$condition['relation'],$condition['value']);
        }
        $query->orderBy($order, $order_direction);
        return $query;
    }
    
    protected function getGroupEditable(string $namespace)
    {
        $list = $namespace::getAllPropertyDefinitions();
        foreach ($list as $entry) {
            if ($entry->get_groupeditable()) {
                return true;
            }
        }
        return false;
    }
    
    
}