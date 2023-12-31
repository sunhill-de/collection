<?php

namespace Sunhill\Collection\Controllers\Network;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Network\IndexResponse;

class NetworkController extends Controller
{
    
    public function index()
    {
        $response = new IndexResponse();
        return $response->response();
    }
    
 }
