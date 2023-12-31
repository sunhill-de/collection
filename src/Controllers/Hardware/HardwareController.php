<?php

namespace Sunhill\Collection\Controllers\Hardware;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Hardware\IndexResponse;

class HardwareController extends Controller
{
    
    public function index()
    {
        $response = new IndexResponse();
        return $response->response();
    }
    
 }
