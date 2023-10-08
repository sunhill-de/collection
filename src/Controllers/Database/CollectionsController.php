<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Database\Collections\ListCollectionsResponse;
use Sunhill\Collection\Response\Database\Collections\ShowCollectionResponse;
use Sunhill\Collection\Response\Database\Collections\ListCollectionResponse;
use Sunhill\Collection\Response\Database\Collections\CollectionDialogResponse;
use Sunhill\Collection\Response\Database\Collections\DeleteCollectionResponse;

class CollectionsController extends Controller
{
    
    public function index()
    {
        $response = new SunhillTileViewResponse();
        return $response->response();
    }
    
    public function list($page=0,$order='id')
    {
        $response = new ListCollectionsResponse();
        $response->setOffset($page);
        $response->setOrder($order);
        return $response->response();
    }
    
    public function show($collection)
    {
        $response = new ShowCollectionResponse();
        $response->setCollection($collection);
        return $response->response();
    }
    
    public function listCollection(string $collection, $page = 0, $order = 'id')
    {
        $response = new ListCollectionResponse();
        $response->setCollection($collection)->setOffset($page)->setOrder($order);
        return $response->response();
    }
    
    public function add(string $collection)
    {
        $response = new CollectionDialogResponse();
        $response->setMode('add');
        $response->setCollection($collection);
        return $response->response();
    }
    
    public function execAdd(string $collection)
    {
        $response = new CollectionDialogResponse();
        $response->setMode('execadd');
        $response->setCollection($collection);
        return $response->response();
    }
    
    public function edit(string $collection, int $id)
    {
        $response = new CollectionDialogResponse();
        $response->setMode('edit');
        $response->setID($id);
        $response->setCollection($collection);
        return $response->response();
    }
    
    public function execEdit(string $collection, int $id)
    {
        $response = new CollectionDialogResponse();
        $response->setMode('execedit');
        $response->setID($id);
        $response->setCollection($collection);
        return $response->response();
    }
    
    public function delete(string $collection, int $id)
    {
        $response = new DeleteCollectionResponse();
        $response->setID($id);
        $response->setCollection($collection);
        return $response->response();
    }
        
}
