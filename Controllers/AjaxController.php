<?php

namespace Sunhill\InfoMarket\Controllers;

use Illuminate\Routing\Controller;
use Sunhill\Visual\Facades\Dialogs;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Sunhill\InfoMarket\Facades\InfoMarket;

class AjaxController extends Controller
{

  public function getItem(string $item="", Request $request,Response $response)
  {
    return $item;
  }
  
}
