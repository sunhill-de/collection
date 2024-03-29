<?php

namespace Sunhill\Collection\Controllers;

use Illuminate\Routing\Controller;
use Sunhill\ORM\Facades\Attributes;
use Sunhill\ORM\Facades\Classes;
use Sunhill\ORM\Facades\Tags;
use Sunhill\Visual\Facades\Dialogs;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

define('ANYWHERE', true);
define('LIMIT', 10);

class AjaxController extends Controller
{

  public function searchImportSeries()
  {
     $search = request()->input('search');
     $query = DB::table('import_movies')->where('title','like','%'.$search.'%')->where('type','series')->limit(10)->get();
     $result = [];
     foreach ($query as $entry) {
        $listentry = new \StdClass();
        $listentry->label = $entry->title;
        $listentry->id = $entry->id;
        $result[] = $listentry;
     }
     return $this->getOutput($result);
  }
  
  public function searchClass()
  {
  }
  
  protected function mergeResult($result1,$result2)
  {
  }
  
  protected function getOutput($result)
  {
        return response()->json($result,200)->header('Content-type', 'application/json');
  }
  
  public function getArrayOfStringSuggestion(string $class, string $field, Request $request)
  {
      $search = $request->input('search');
      $query = DB::table('stringobjectassigns')
       ->join('objects','stringobjectassigns.container_id','=','objects.id')
       ->select('element_id')
       ->where('stringobjectassigns.field',$field)
       ->where('element_id','like','%'.$search.'%')
       ->groupBy('element_id')
       ->get();
       $newresult = [];
       foreach ($query as $entry) {
           $newentry = new \StdClass();
           $newentry->label = $entry->element_id;
           $newentry->id = $entry->element_id;
           $newresult[] = $newentry;
       }
       return $this->getOutput($newresult);
  }
  
  public function searchObjects(string $class, string $field, Request $request)
  {     
      $search = $request->input('search');
      $result = Dialogs::searchKeyfieldForField($class,$field,$search,ANYWHERE,LIMIT);
      $newresult = [];
      foreach ($result as $entry) {
          $newentry = new \StdClass();
          $newentry->label = $entry['keyfield'];
          $newentry->id = $entry['id'];
          $newresult[] = $newentry;
      }
      return $this->getOutput($newresult);      
  }
  
  public function searchObject(string $class, Request $request)
  {
      $search = $request->input('search');
      $result = Dialogs::searchKeyfield($class,$search,ANYWHERE,LIMIT);
      $newresult = [];
      foreach ($result as $entry) {
          $newentry = new \StdClass();
          $newentry->label = $entry['keyfield'];
          $newentry->id = $entry['id'];
          $newresult[] = $newentry;
      }
      return $this->getOutput($newresult);
  }
  
  public function getClass(string $parent="", Request $request, Response $response)
  {
      
      $children = Classes::getChildrenOfClass($parent,1);
      
      $result = [];
      foreach ($children as $child => $info) {
          $node_data = [];
          $node_data['id'] = $child;
          
          if ($parent == 'object') {
              $node_data['type'] = 'root';
              $node_data['parent'] = "#";
          } else {
              $node_data['parent'] = $parent;
          }
          $node_data['text'] = $child;
          if (empty(Classes::getChildrenOfClass($child,1))) {
              $node_data["icon"] = "fa fa-file fa-large kt-font-default";
              $node_data["children"] = false;              
          } else {
              $node_data["icon"] = "fa fa-folder icon-lg";
              $node_data["children"] = true;              
          }
          $result[] = $node_data;
      }
      
      return response()->json($result);
  }
  
  public function getAttributeType(string $attribute)
  {
      return Attributes::getAttributeType($attribute);    
  }
  
}
