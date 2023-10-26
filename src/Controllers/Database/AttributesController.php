<?php

namespace Sunhill\Collection\Controllers\Database;

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

class AttributesController extends CrudController
{
    
    protected static $crud_response = AttributesCrudResponse::class;
    
    public function listChildren(int $id, $offset = 0)
    {
        $response = new ListChildrenResponse();
        $response->setID($id);
        return $response->response();
    }
    
    public function listAssociatedObjects(int $id, $offset = 0)
    {
        $response = new ListAssociatedObjectsResponse();
        $response->setID($id);
        return $response->response();
    }
}
