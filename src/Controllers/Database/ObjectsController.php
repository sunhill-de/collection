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
use Sunhill\Collection\Response\Database\Collections\CollectionDialogResponse;
use Sunhill\Collection\Response\Database\Objects\ObjectsDialogResponse;

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
            $response = new ObjectsDialogResponse();
            $response->setMode('add');
            $response->setCollection($class);
        }
        return $response->response();
    }
    
    public function execAdd($class)
    {
        $response = new ObjectsDialogResponse();
        $response->setMode('execadd');
        $response->setCollection($class);
        return $response->response();
    }
    
    public function edit($id)
    {
        $response = new ObjectsDialogResponse();
        $response->setMode('edit');
        $response->setID($id);
        return $response->response();        
    }
    
    public function execEdit($id)
    {
        $response = new ObjectsDialogResponse();
        $response->setMode('execedit');
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
