<?php

namespace Sunhill\Collection\Controllers\Database;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Database\Collections\ListCollectionsResponse;
use Sunhill\Collection\Response\Database\Collections\ShowCollectionResponse;
use Sunhill\Collection\Response\Database\Collections\ListCollectionResponse;

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
}
