<?php

namespace Sunhill\Collection\Controllers\Information;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Information\News\IndexResponse;
use Sunhill\Collection\Response\Information\News\ShowNewsResponse;

class NewsController extends Controller
{
    
    public function index()
    {
        $response = new IndexResponse();
        return $response->response();
    }
   
    public function show($id)
    {
        $response = new ShowNewsResponse();
        $response->setID($id);
        return $response->response();
        
    }
    
 }
