<?php

namespace Sunhill\Collection\Controllers\Infomarket;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\InfoMarket\IndexResponse;
use Sunhill\Collection\Response\Database\Classes\ListClassesResponse;
use Sunhill\Collection\Response\Database\Classes\ShowClassResponse;

class InfomarketController extends Controller
{
    
    public function index()
    {
        $response = new IndexResponse();
        return $response->response();
    }
    
 }
