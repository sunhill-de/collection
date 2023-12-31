<?php

namespace Sunhill\Collection\Controllers\Dates;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Dates\IndexResponse;

class DatesController extends Controller
{
    
    public function index()
    {
        $response = new IndexResponse();
        return $response->response();
    }
    
 }
