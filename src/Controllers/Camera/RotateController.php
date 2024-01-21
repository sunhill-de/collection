<?php

namespace Sunhill\Collection\Controllers\Camera;

use Illuminate\Routing\Controller;
use Sunhill\Collection\Visual\SunhillTileViewResponse;

use Sunhill\Collection\Response\Database\Attributes\AddAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\ExecAddAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\EditAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\ExecEditAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\DeleteAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\ListAttributesResponse;
use Sunhill\Collection\Response\Database\Attributes\ShowAttributeResponse;
use Sunhill\Collection\Response\Database\Attributes\ListChildrenResponse;
use Sunhill\Collection\Response\Database\Attributes\ListAssociatedObjectsResponse;
use Sunhill\Collection\Response\Database\Attributes\AttributeDialogResponse;
use Sunhill\Visual\Controllers\CrudController;
use Sunhill\Collection\Response\Database\Attributes\AttributesCrudResponse;
use Sunhill\Collection\Response\Cameras\RotateResponse;
use Sunhill\Collection\Response\Cameras\RotateFullscreenResponse;

class RotateController extends Controller
{
        
    public function index()
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
