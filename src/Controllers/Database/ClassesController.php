<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\SunhillTileViewResponse;
use Sunhill\Collection\Response\Database\Classes\ListClassesResponse;
use Sunhill\Collection\Response\Database\Classes\ShowClassResponse;

class ClassesController extends Controller
{
    
    public function index()
    {
        $response = new SunhillTileViewResponse();
        return $response->response();
    }
    
    public function list($page=0)
    {
        $response = new ListClassesResponse();
        $response->setdelta($page);
        return $response->response();
    }
    
    public function show($class)
    {
        $response = new ShowClassResponse();
        $response->setClass($class);
        return $response->response();
    }
}
