<?php

namespace Sunhill\Collection\Controllers\News;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\News\IndexResponse;

class NewsController extends Controller
{
    
    public function index()
    {
        $response = new IndexResponse();
        return $response->response();
    }
    
 }
