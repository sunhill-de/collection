<?php

namespace Sunhill\Collection\Importer;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

trait EventUtils
{
    
    protected function searchImportEvent(string $refering_collection, int $refering_id, string $event_type, string $date, $user = null)
    {
        return ImportEvent()::query()
               ->where('to_whom_table', $refering_collection)
               ->where('to_whom_id', $refering_id);
    }
    
    protected function searchEvent(string $refering_table, int $refering_id, string $event_type, string $date, $user = null)
    {
        return false;
    }

    /**
     * Transforms a german date (dd.mm.YYYY) into a database date (YYY-mm-dd)
     * @param unknown $date
     * @return string
     */
    protected function getDate($date)
    {
        return Carbon::createFromFormat('d.m.Y', trim($date))->format('Y-m-d');
    }
    
    protected function insertEvent(string $refering_table, int $refering_id, string $event_type, string $date, $user = null)
    {
    }
    
    protected function searchOrInsertEvent(string $refering_table, int $refering_id, string $event_type, string $date, string $user)
    {
    }
    
    protected function eventIsAlreadyImported(int $id)
    {
    }
}