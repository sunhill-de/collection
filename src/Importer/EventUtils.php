<?php

namespace Sunhill\Collection\Importer;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

trait EventUtils
{
    
    protected function searchEvent(string $refering_table, int $refering_id, string $event_type, string $date)
    {
        if ($result = DB::table('import_events')->where('refering_table',$refering_table)->where('refering_id',$refering_id)->where('event_type',$event_type)->where('date',$date)->first())
        {
            return $result->id;
        }
        return false;
    }

    protected function getDate($date)
    {
        return Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d');
    }
    
    protected function insertEvent(string $refering_table, int $refering_id, string $event_type, string $date)
    {
        DB::table('import_events')->insert(['refering_table'=>$refering_table,'refering_id'=>$refering_id,'event_type'=>$event_type,'date'=>$date]);
        return DB::getPdo()->lastInsertId();
    }
    
    protected function searchOrInsertEvent(string $refering_table, int $refering_id, string $event_type, string $date)
    {
        if ($result = $this->searchEvent($refering_table,$refering_id,$event_type,$date)) {
            return $result;
        }
        return $this->insertEvent($refering_table,$refering_id,$event_type,$date);
    }
    
    protected function isAlreadyImported(int $id)
    {
        $result = DB::table('import_events')->where('id',$id)->first();
        return $result->event_id > 0;
    }
}