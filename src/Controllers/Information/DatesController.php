<?php

namespace Sunhill\Collection\Controllers\Information;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Information\Dates\IndexResponse;

class DatesController extends Controller
{
    
    public function index()
    {
        $response = new IndexResponse();
        return $response->response();
    }
    
 }
