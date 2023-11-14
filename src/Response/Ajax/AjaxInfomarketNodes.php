<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxSearchResponse;
use Illuminate\Support\Facades\DB;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Facades\InfoMarket;

class AjaxInfomarketNodes extends AjaxSearchResponse
{
    
    protected function assembleSearchResult(string $search = '')
    {
        $nodes = InfoMarket::getItem($search, 'anybody', 'object');
        $result = [];
        foreach ($nodes->value as $node => $desc) {
            $node_data = [];
            if ($search == '') {
                $node_data['type'] = 'root';
                $node_data['id'] = $node;
                $node_data['parent'] = "#";
            } else {
                $node_data['id'] = $search.'.'.$node;
                $node_data['parent'] = $search;
            }
            $subnode = InfoMarket::getItem($node_data['id'], 'anybody', 'object');
            switch ($subnode->type)
            {
                case 'array':
                case 'object':    
                    $node_data['text'] = $node;
                    $node_data["icon"] = "fa fa-folder icon-lg";
                    $node_data["children"] = true;
                    break;
                default:    
                    $node_data['text'] = $node.': <div class="value">'.$subnode->value.'</div>';
                    $node_data["icon"] = "fa fa-file fa-large kt-font-default";
                    $node_data["children"] = false;
            }

            $result[] = $node_data;
        }
        
        return $result;
    }
    
}