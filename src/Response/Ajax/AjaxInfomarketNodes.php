<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxSearchResponse;
use Illuminate\Support\Facades\DB;
use Sunhill\ORM\Facades\Tags;
use Sunhill\ORM\Facades\InfoMarket;

class AjaxInfomarketNodes extends AjaxSearchResponse
{
    
    protected function assembleSearchResult(string $search)
    {
        $nodes = InfoMarket::getNodes(($search=="!root!")?"":$search, 'object','anybody');
        $result = [];
        foreach ($nodes as $node) {
            $node_data = [];
            if ($search == '!root!') {
                $node_data['type'] = 'root';
                $node_data['id'] = $node->name;
                $node_data['parent'] = "#";
            } else {
                $node_data['id'] = $search.'.'.$node->name;
                $node_data['parent'] = $search;
            }
            $node_data['text'] = $node->name;
            if ($node->semantic == 'Branch') {
                $node_data["icon"] = "fa fa-folder icon-lg";
                $node_data["children"] = true;
            } else {
                $node_data["icon"] = "fa fa-file fa-large kt-font-default";
                $node_data["children"] = false;
            }
            $result[] = $node_data;
        }
        
        return $result;
    }
    
}