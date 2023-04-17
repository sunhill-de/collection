<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\SunhillTileViewResponse;
use Sunhill\Collection\Response\Database\Objects\ListObjectsResponse;
use Sunhill\Collection\Response\Database\Objects\ShowObjectResponse;
use Sunhill\Collection\Response\Database\Objects\AddObjectResponse;
use Sunhill\Collection\Response\Database\Objects\EditObjectResponse;
use Sunhill\Collection\Response\Database\Classes\ChooseClassResponse;
use Sunhill\Collection\Response\Database\Objects\ExecAddObjectResponse;
use Sunhill\Collection\Response\Database\Objects\ExecEditObjectResponse;
use Sunhill\Collection\Response\Database\Objects\DeleteObjectResponse;

class ObjectsController extends Controller
{
    
    public function index()
    {
        $response = new SunhillTileViewResponse();
        return $response->response();
    }
    
    public function list($key='object',$page=0,$order='id')
    {
        $response = new ListObjectsResponse();
        $response->setOffset($page);
        $response->setKey($key);
        $response->setOrder($order);
        return $response->response();
    }
    
    public function show($id)
    {
        $response = new ShowObjectResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function add($class=null)
    {
        if (is_null($class)) {
            $response = new ChooseClassResponse();
            $response->setAction(route('objects.add'));
        } else {
            $response = new AddObjectResponse();
            $response->setClass($class);
        }
        return $response->response();
    }
    
    public function execAdd()
    {
        $response = new ExecAddObjectResponse();
        return $response->response();
    }
    
    public function edit($id)
    {
        $response = new EditObjectResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function execEdit($id)
    {
        $response = new ExecEditObjectResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function delete($id)
    {
        $response = new DeleteObjectResponse();
        $response->setID($id);
        return $response->response();
    }
    
}
