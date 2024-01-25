<?php

namespace Sunhill\Collection\Controllers\Camera;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Response\Cameras\RotateResponse;
use Sunhill\Collection\Response\Cameras\RotateFullscreenResponse;
use Sunhill\Collection\Response\Cameras\CamerasIndexResponse;
use Sunhill\Collection\Response\Cameras\ShowCameraResponse;
use Sunhill\Collection\Response\Cameras\ShowCameraFullscreenResponse;

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
    
    public function show(int $id)
    {
        $response = new ShowCameraResponse();
        $response->setID($id);
        
        return $response->response();
    }
    
    public function showFullscreen(int $id)
    {
        $response = new ShowCameraFullscreenResponse();
        $response->setID($id);
        
        return $response->response();
    }
    
}
