<?php

namespace Sunhill\Collection\Controllers\Weather;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Weather\IndexResponse;

class WeatherController extends Controller
{
    
    public function index()
    {
        $response = new IndexResponse();
        return $response->response();
    }
    
 }
