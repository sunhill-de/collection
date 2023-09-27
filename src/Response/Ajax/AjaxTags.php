<?php

namespace Sunhill\Collection\Response\Ajax;

use Sunhill\Visual\Response\Ajax\AjaxSearchResponse;
use Illuminate\Support\Facades\DB;
use Sunhill\ORM\Facades\Tags;

class AjaxTags extends AjaxSearchResponse
{
    
    protected function assembleSearchResult(string $search)
    {
        $query = DB::table('tagcache')->select('tag_id')->where('path_name','like','%'.$search.'%')->groupBy('tag_id')->get();
        $newresult = [];
        foreach ($query as $entry) {
            $tag = Tags::getTag($entry->tag_id);
            $newresult[] = $this->makeStdclass(['label'=>$tag->fullpath,'id'=>$tag->getID()]);
        }
        return $newresult;
    }
    
}