<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Visual\SunhillTileViewResponse;

use Sunhill\Collection\Response\Database\Attributes\AddAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\ExecAddAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\EditAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\ExecEditAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\DeleteAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\ListAttributesResponse;
use Sunhill\Collection\Response\Database\Attributes\ShowAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\ListChildrenResponse;
use Sunhill\Collection\Response\Database\Attributes\ListAssociatedObjectsResponse;

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
        $response = new ShowAttributeResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function add()
    {
        $response = new AddAttributeResponse();
        return $response->response();
    }
    
    public function execAdd()
    {
        $response = new ExecAddAttributeResponse();
        return $response->response();
    }
    
    public function edit($id)
    {
        $response = new EditAttributeResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function execEdit($id)
    {
        $response = new ExecEditAttributeResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function delete($id)
    {
        $response = new DeleteAttributeResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function listChildren(int $id, $offset = 0)
    {
        $response = new ListChildrenResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function listAssociatedObjects(int $id, $offset = 0)
    {
        $response = new ListAssociatedObjectsResponse();
        $response->setID($id);
        return $response->response();
    }
}
