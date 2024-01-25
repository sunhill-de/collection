<?php

namespace Sunhill\Collection\Controllers\Camera;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Cameras\RotateResponse;
use Sunhill\Collection\Response\Cameras\RotateFullscreenResponse;
use Sunhill\Collection\Response\Cameras\CamerasIndexResponse;

class CamerasController extends Controller
{
    
    public function index()
    {
        $response = new CamerasIndexResponse();
        return $response->response();
    }
    
    public function rotate()
    {
        $response = new RotateResponse();
        return $response->response();
    }
    
    public function rotateFullscreen()
    {
        $response = new RotateFullscreenResponse();
        return $response->response();
    }
    
}
