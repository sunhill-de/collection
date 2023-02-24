<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\SunhillTileViewResponse;
use Sunhill\Collection\Response\Database\Classes\ListClassesResponse;
use Sunhill\Collection\Response\Database\Classes\ShowClassResponse;

class AttributesController extends Controller
{
    
    public function index()
    {
        $response = new SunhillTileViewResponse();
        return $response->response();
    }
    
    public function list($page=0)
    {
        $response = new ListAttributesResponse();
        $response->setdelta($page);
        return $response->response();
    }
    
    public function show($id)
    {
        $response = new ShowAttributesResponse();
        $response->setID($id);
        return $response->response();
    }
}
