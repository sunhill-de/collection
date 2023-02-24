<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\SunhillTileViewResponse;
use Sunhill\Collection\Response\Database\Classes\ListClassesResponse;
use Sunhill\Collection\Response\Database\Classes\ShowClassResponse;

class TagsController extends Controller
{
    
    public function index()
    {
        $response = new SunhillTileViewResponse();
        return $response->response();
    }
    
    public function list($page=0)
    {
        $response = new ListTagsResponse();
        $response->setdelta($page);
        return $response->response();
    }
    
    public function show($id)
    {
        $response = new ShowTagsResponse();
        $response->setID($id);
        return $response->response();
    }
}
