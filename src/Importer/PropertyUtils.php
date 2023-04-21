<?php

namespace Sunhill\Collection\Importer;

use Illuminate\Support\Facades\DB;

trait PropertyUtils
{
    
    protected function searchProperty(string $refering_table, int $refering_id)
    {
        if ($result = DB::table('import_properties')
            ->where('refering_table',$refering_table)
            ->where('refering_id',$refering_id)
            ->first())
        {
            return $result->id;
        }
        return false;
    }
    
    protected function insertProperty(string $refering_table, int $refering_id, string $name, string $ean, string $type)
    {
        DB::table('import_properties')->insert(
            [
                'refering_table'=>$refering_table,
                'refering_id'=>$refering_id,
                'name'=>$name,
                'ean'=>$ean, 
                'type'=>$type                
            ]);
        return DB::getPdo()->lastInsertId();
    }
    
    protected function searchOrInsertProperty(string $refering_table, int $refering_id, string $name, string $ean, string $type)
    {
        if ($result = $this->searchProperty($refering_table,$refering_id)) {
            return $result;
        }
        return $this->insertProperty($refering_table,$refering_id,$name, $ean, $type);
    }
    
    protected function PropertyIsAlreadyImported(int $id)
    {
        $result = DB::table('import_properties')->where('id',$id)->first();
        return $result->object_id > 0;
    }

}