<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\SunhillTileViewResponse;
use Sunhill\Collection\Response\Database\Classes\ListClassesResponse;
use Sunhill\Collection\Response\Database\Classes\ShowClassResponse;
use Sunhill\Collection\Response\Database\Classes\ChooseClassResponse;
use Sunhill\Collection\Response\Database\Classes\SelectClassesResponse;

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
    
    public function select()
    {
       $response = new SelectClassesResponse();
       return $response->response();
    }
    
    public function choose()
    {
        $response = new ChooseClassResponse();
        return $response->response();
    }
    
}
