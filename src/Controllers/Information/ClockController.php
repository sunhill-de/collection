<?php

namespace Sunhill\Collection\Controllers\Information;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Information\Clock\IndexResponse;

class ClockController extends Controller
{
    
    public function index()
    {
        $response = new IndexResponse();
        return $response->response();
    }
    
 }
