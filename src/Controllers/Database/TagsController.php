<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Visual\Response\SunhillTileViewResponse;

use Sunhill\Collection\Response\Database\Tags\AddTagResponse;
use Sunhill\Collection\Response\Database\Tags\ExecAddTagResponse;
use Sunhill\Collection\Response\Database\Tags\EditTagResponse;
use Sunhill\Collection\Response\Database\Tags\ExecEditTagResponse;
use Sunhill\Collection\Response\Database\Tags\DeleteTagResponse;
use Sunhill\Collection\Response\Database\Tags\ListTagsResponse;
use Sunhill\Collection\Response\Database\Tags\ShowTagResponse;
use Sunhill\Collection\Response\Database\Tags\ListChildrenResponse;
use Sunhill\Collection\Response\Database\Tags\ListAssociatedObjectsResponse;

class TagsController extends Controller
{
    
    public function index()
    {
        $response = new SunhillTileViewResponse();
        return $response->response();
    }
    
    public function list($page = 0, $order = 'id')
    {
        $response = new ListTagsResponse();
        $response->setOffset($page);
        $response->setOrder($order);
        return $response->response();
    }
    
    public function show($id)
    {
        $response = new ShowTagResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function add()
    {
        $response = new AddTagResponse();
        return $response->response();        
    }

    public function execAdd()
    {
        $response = new ExecAddTagResponse();
        return $response->response();
    }
       
    public function edit($id)
    {
        $response = new EditTagResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function execEdit($id)
    {
        $response = new ExecEditTagResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function delete($id)
    {
        $response = new DeleteTagResponse();
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
    
